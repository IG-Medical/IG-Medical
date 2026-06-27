<?php


namespace Product\Http\Controllers\AdminPanel\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Product\Http\Controllers\AdminPanel\CoreController;
use Product\Http\Requests\AdminPanel\Product\StoreProductRequest;
use Product\Http\Requests\AdminPanel\Product\UpdateProductRequest;
use Product\Http\Resources\AdminPanel\Product\ProductResource;
use Product\Http\Resources\AdminPanel\Product\ProductsResource;
use Product\Mail\DownloadPDFProductsMail;
use Product\Models\DownloadRequestsProduct;
use Product\Models\Product;
use Product\Models\ProductAttachments;
use Product\Models\ProductAttribute;
use Product\Models\Wishlist;
use Product\Providers\AppServiceProvider;

class ProductController extends CoreController
{
    use ProductTrait;

    public function __construct(Product $product)
    {
        $this->moduleDirView = AppServiceProvider::$moduleNamespace . '::' . ADMIN_VIEWS_DIR . '.products';
        $this->moduleRoute = AppServiceProvider::$moduleNamePrefix;
        $this->moduleNamespace = AppServiceProvider::$moduleNamespace;
        parent::__construct($product);
    }

    public function acceptDownloadFile(Request $request)
    {
        $id = $request->id;
        if(is_null($id))
            abort(404);

        $req = DownloadRequestsProduct::with('product')->findOrFail($id);
        Mail::to($req->email)->send(new DownloadPDFProductsMail($req));
        $req->update([
            'status' => (string)YES,
        ]);
        return redirect()->to(route_admin('dashboard.index'))->with('success_message',trans('messages.success'));
    }

    public function index()
    {
        meta_data(trans_module_product('admin.products'), trans_module_product('admin.products'), [
            '' => trans_module_product('admin.products')
        ]);

        $singleTitle = trans_module_product('admin.product');
        $asRoute = $this->moduleNamespace;
        $route = $this->moduleRoute;
        $DIR_UPLOADS = ProductAttachments::DIR_UPLOADS;

        return view($this->moduleDirView . '.index', compact('singleTitle', 'route', 'asRoute', 'DIR_UPLOADS'));
    }


    public function create()
    {
        meta_data(trans_module_product('admin.products'), trans_module_product('admin.products'), [
            route_admin('product.index') => trans_module_product('admin.products'),
            '' => trans_module_product('admin.create') . ' ' . trans_module_product('admin.product'),
        ]);

        $DIR_UPLOADS = ProductAttachments::DIR_UPLOADS;
        $asRoute = $this->moduleNamespace;
        $singleTitle = trans_module_product('admin.product');
        return view($this->moduleDirView . '.create', compact('asRoute', 'DIR_UPLOADS', 'singleTitle'));
    }

    public function data(Request $request)
    {
        $products = new $this->model();

        $products = $this->filter($request, $products);

        $products = $this->sort($request, $products);

        $products = $products->paginate(ADMIN_PER_PAGE);

        $data = ProductsResource::collection($products);
        $meta = collect($products)->except('data');

        return $this->response([
            'data' => $data,
            'meta' => $meta
        ]);
    }


    public function edit($id)
    {
        meta_data(trans_module_product('admin.products'), trans_module_product('admin.products'), [
            route_admin('product.index') => trans_module_product('admin.products'),
            '' => trans_module_product('admin.edit') . ' ' . trans_module_product('admin.product'),
        ]);

        $asRoute = $this->moduleNamespace;

        $product = new ProductResource($this->model::with('gallery', 'attributes.productAttributeValues', 'options')->findOrFail($id));

        $DIR_UPLOADS = ProductAttachments::DIR_UPLOADS;

        return view($this->moduleDirView . '.create', compact('asRoute', 'product', 'DIR_UPLOADS'));
    }

    public function store(StoreProductRequest $request)
    {
        $store = DB::transaction(function () use ($request) {

            $id = $request->id;

            if ($id) {
                $store = $this->model::find($id);
            } else {
                $store = new $this->model;
            }

            if (isset($request->icon['file_link'])) {
                $icon = $request->icon['file_link'];
            } else if (!empty($request->icon) and is_string($request->icon)) {
                $icon =  $request->icon;
            } else {
                $icon = null;
            }

            $store->name = $request->name;
            $store->slug = $this->handlerSlug($request);
            $store->short_description = $request->short_description;
            $store->description = $request->description;
            $store->basic_configuration = $request->basic_configuration;
            $store->category_id = $request->category;
            $store->main_image = $request->main_image;
            $store->icon = $icon;
            $store->is_active = $request->is_active;
            $store->youtube = $request->youtube;
            $store->pdf = $request->pdf;
            $store->save();

            if ($request->has('image_gallery')) {
                ProductAttachments::store($request->image_gallery, $store->id);
            }

            if ($request->has('rowsAttributes')) {
                ProductAttribute::store($request->rowsAttributes, $store->id);
            }

            return $store;
        });
        Cache::forget('productsFooter');
        Cache::forget('productsHeader1');
        Cache::forget('productsHeader2');
        Cache::forget('categoriesHeader1');
        Cache::forget('categoriesHeader2');
        return $this->successResponse($store);
    }

    public function handlerSlug(Request $request)
    {

        return is_null($request->slug) ? Str::slug($request->name['en']) : $request->slug;
    }

    public function update(UpdateProductRequest $request)
    {
        $id = $request->id;
        $store = $this->model::find($id);
        if ($request->has('discount_percentage') && !is_null($request->discount_percentage))
            $store->discount_percentage = $request->discount_percentage;
        if ($request->has('qty') && !is_null($request->qty))
            $store->qty = $request->qty;
        $store->save();
        return $this->successResponse($store);
    }

    public function destroy($id)
    {
        try {
            $product = $this->model::findOrFail($id);
            $delete = $product->delete();
            
            Cache::forget('productsFooter');
            Cache::forget('productsHeader1');
            Cache::forget('productsHeader2');
            
            if (request()->expectsJson()) {
                return $this->deleteResponse($delete);
            }
            
            $message = $delete ? trans('messages.success_delete') : trans('messages.error_delete');
            return redirect()->to(route_admin('product.index'))->with($delete ? 'success_message' : 'error_message', $message);
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return $this->errorResponse(null, trans('messages.error_delete'), 404);
            }
            
            return redirect()->to(route_admin('product.index'))->with('error_message', trans('messages.error_delete'));
        }
    }

    public function restore($id)
    {
        try {
            $product = $this->model::onlyTrashed()->findOrFail($id);
            $restore = $product->restore();
            
            Cache::forget('productsFooter');
            Cache::forget('productsHeader1');
            Cache::forget('productsHeader2');
            
            $message = $restore ? trans('messages.success_restore') : trans('messages.error_restore');
            
            if (request()->expectsJson()) {
                return $this->successResponse($restore, $message);
            }
            
            return redirect()->to(route_admin('product.index'))->with($restore ? 'success_message' : 'error_message', $message);
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return $this->errorResponse(null, trans('messages.error_restore'), 404);
            }
            
            return redirect()->to(route_admin('product.index'))->with('error_message', trans('messages.error_restore'));
        }
    }

    public function forceDelete($id)
    {
        try {
            $product = $this->model::onlyTrashed()->findOrFail($id);

            DB::transaction(function () use ($product) {
                // Remove relations that use ON_DELETE NO ACTION so the product can be deleted
                ProductAttachments::where('product_id', $product->id)->delete();
                ProductAttribute::where('product_id', $product->id)->delete();
                $product->options()->detach();
                Wishlist::where('product_id', $product->id)->delete();
                $product->banners()->detach();
                // Unlink child products so they are not orphaned by FK constraint
                $this->model::where('product_id', $product->id)->update(['product_id' => null]);

                $product->forceDelete();
            });

            Cache::forget('productsFooter');
            Cache::forget('productsHeader1');
            Cache::forget('productsHeader2');

            if (request()->expectsJson()) {
                return $this->deleteResponse(true);
            }

            return redirect()->to(route_admin('product.index'))->with('success_message', trans('messages.success_delete'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return $this->errorResponse(null, trans('messages.error_delete'), 404);
            }

            return redirect()->to(route_admin('product.index'))->with('error_message', trans('messages.error_delete'));
        }
    }

}
