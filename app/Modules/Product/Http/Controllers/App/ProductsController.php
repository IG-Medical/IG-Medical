<?php


namespace Product\Http\Controllers\App;

use App\Http\Resources\CountryResource;
use App\Models\Country;
use Category\Models\Category;
use Product\Models\Product;
use Product\Providers\AppServiceProvider;

class ProductsController extends CoreController
{
    use ProductTrait;

    public function __construct()
    {
        $this->moduleDirView = AppServiceProvider::$moduleNamespace . '::' . APP_VIEWS_DIR . '.products';
        $this->moduleNamespace = AppServiceProvider::$moduleNamespace;
        parent::__construct();
    }

//    public function index(Request $request)
//    {
//        $type = $request->category;
//
//        if (is_null($type))
//            return back();
//
//        $categories = [];
//        $category = null;
//
//        if ($type === 'products') {
//            $cateId = Category::TYPE_PRODUCT;
//            $pageTitle = trans_module_product('app.product');
//            $categories = Category::where('parent_id', $cateId)->get();
//            $category = Category::find($cateId);
//            $viewBlade = 'products';
//        } else {
//            $cateId = Category::TYPE_OPERATING_ROOM;
//            $pageTitle = trans_module_product('app.operating_room');
//            $viewBlade = 'operating-room';
//            $category = Category::with('children1.products')->findOrFail($cateId);
//        }
//
//
//        meta_data(trans_module_product('app.home'), trans_module_product('app.home'), [
//            '' => $pageTitle
//        ]);
//
//        return view($this->moduleDirView . '.products.' . $viewBlade,
//            compact('pageTitle', 'categories', 'category')
//        );
//    }

    public function showProductsPage()
    {
        $cateId = Category::TYPE_PRODUCT;
        $pageTitle = trans_module_product('app.products');
        $categories = Category::where('parent_id', $cateId)->get();
        $category = Category::find($cateId);
        $viewBlade = 'products';

        meta_data(trans_module_product('app.home'), trans_module_product('app.home'), [
            '' => $pageTitle
        ]);
        $breadcrumbsProducts = true;
        return view($this->moduleDirView . '.products.' . $viewBlade,
            compact('pageTitle', 'categories', 'category', 'breadcrumbsProducts')
        );
    }

    public function showOperatingRoomPage()
    {
        $cateId = Category::TYPE_OPERATING_ROOM;
        $pageTitle = trans_module_product('app.operating_room');
        $viewBlade = 'operating-room';
        $category = Category::with('children1.products')->findOrFail($cateId);


        meta_data(trans_module_product('app.home'), trans_module_product('app.home'), [
            '' => $pageTitle
        ]);
        $breadcrumbsOperatingRoom = true;
        return view($this->moduleDirView . '.products.' . $viewBlade,
            compact('pageTitle', 'category', 'breadcrumbsOperatingRoom')
        );
    }


    public function productsByCategory($cate)
    {
        $category = Category::with('products', 'parent1')->where('slug', $cate)->firstOrFail();
        $pageTitle = $category->name;
        $parent = $category->parent;

        $breadcrumbsProducts = null;
        $breadcrumbsOperatingRoom = null;

        $sub_title2 = [];
        if ($parent->id === Category::TYPE_PRODUCT) {
            $breadcrumbsProducts = true;
            $sub_title2 [route('product.showProductsPage')] = $parent->name;
        }

        if ($parent->id === Category::TYPE_OPERATING_ROOM) {
            $breadcrumbsOperatingRoom = true;
            $sub_title2 [route('product.showOperatingRoomPage')] = $parent->name;
        }

        meta_data(trans_module_product('app.home'), trans_module_product('app.home'), array_merge($sub_title2, ['' => $pageTitle,]));

        return view($this->moduleDirView . '.products.products-by-category', compact(
            'pageTitle', 'category', 'breadcrumbsOperatingRoom', 'breadcrumbsProducts'));
    }

    public function details($slug)
    {
        $product = Product::where('slug', $slug)->active()->with([
            'attributes.attribute.attributeSet', 'attributes.productAttributeValues.value', 'gallery', 'category.parent1'
        ])->firstOrFail();


        $pageTitle = trans_module_product('app.details');

        $sub_title = $this->breadcrumbs($product);

        meta_data($pageTitle, $pageTitle, $sub_title);

        $attributesProduct = $this->getAttributesProduct($product);

        $asRoute = $this->moduleNamespace;
        $countries = CountryResource::collection(Country::getCountries());
        $pId = isset($product->category->parent1->id) ? $product->category->parent1->id : null;
        $breadcrumbsProducts = null;
        $breadcrumbsOperatingRoom = null;

        if (isset($pId)) {

            if ($pId === Category::TYPE_PRODUCT)
                $breadcrumbsProducts = true;

            if ($pId === Category::TYPE_OPERATING_ROOM)
                $breadcrumbsOperatingRoom = true;
        }

        return view($this->moduleDirView . '.products.details',
            compact('pageTitle',
                'attributesProduct',
                'asRoute',
                'product',
                'breadcrumbsProducts',
                'breadcrumbsOperatingRoom', 'countries'
            )
        );
    }


}
