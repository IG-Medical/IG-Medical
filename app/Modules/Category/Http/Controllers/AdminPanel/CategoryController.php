<?php


namespace Category\Http\Controllers\AdminPanel;

use Category\Http\Requests\AdminPanel\Category\StoreCategoryRequest;
use Category\Http\Resources\AdminPanel\Category\CategoriesResource;
use Category\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CategoryController extends CoreController
{
    use CategoryTrait;

    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    public function index()
    {
        meta_data(trans_module_category('admin.categories'), trans_module_category('admin.categories'), [
            '' => trans_module_category('admin.categories')
        ]);

        $singleTitle = trans_module_category('admin.category');
        $asRoute = $this->moduleNamespace;
        $route = $this->moduleRoute;
        $DIR_UPLOADS = $this->model::DIR_UPLOADS;

        return view($this->moduleDirView . '.index', compact('singleTitle', 'route', 'asRoute', 'DIR_UPLOADS'));
    }


//    public function create()
//    {
//        meta_data(trans_module_category('admin.categories'), trans_module_category('admin.categories'), [
//            route_admin('banner.index') => trans_module_category('admin.categories'),
//            '' => trans_module_category('admin.create') . ' ' . trans_module_category('admin.category'),
//        ]);
//
//        $DIR_UPLOADS = $this->model::DIR_UPLOADS;
//        $asRoute = $this->moduleNamespace;
//        $singleTitle = trans_module_category('admin.category');
//        return view($this->moduleDirView . '.create', compact('asRoute', 'DIR_UPLOADS','singleTitle'));
//    }

    public function data(Request $request)
    {
        $categories = $this->model::whereNull('parent_id')->with('children')->get();
        $data = CategoriesResource::collection($categories);
        
        return $this->response($data);
    }


//    public function edit($id)
//    {
//        meta_data(trans_module_category('admin.categories'), trans_module_category('admin.categories'), [
//            route_admin('banner.index') => trans_module_category('admin.categories'),
//            '' => trans_module_category('admin.edit') . ' ' . trans_module_category('admin.banner'),
//        ]);
//
//        $asRoute = $this->moduleNamespace;
//
//        $category = $this->model::findOrFail($id);
//        $DIR_UPLOADS = $this->model::DIR_UPLOADS;
//
//
//        return view($this->moduleDirView . '.create', compact('asRoute', 'category', 'DIR_UPLOADS'));
//    }

    public function store(StoreCategoryRequest $request)
    {
        $id = $request->id;
        $root_id = $request->root_id;

        if ($id) {
            $store = $this->model::with('parent')->find($id);

        } else if ($root_id) {
            $store = $this->model::with('parent')->find($root_id);
            if (isset($store->parent)) {
                return $this->successResponse(false, trans_module_category('messages.limit_tree'));
            }
            $store = new $this->model;
        } else {
            $store = new $this->model;
        }

        $breadcrumb_video_type =  $request->breadcrumb_video ? 'youtube' : 'iframe';

        if ($request->breadcrumb_video) {
            $breadcrumb_video = $request->breadcrumb_video;
        } else {
            if (isset($request->breadcrumb_video_upload['file_link'])) {
                $breadcrumb_video = $request->breadcrumb_video_upload['file_link'];
            } else if (!empty($request->breadcrumb_video_upload) and is_string($request->breadcrumb_video_upload)) {
                $breadcrumb_video =  $request->breadcrumb_video_upload;
            } else {
                $breadcrumb_video = null;
                $breadcrumb_video_type = null;
            }
        }

        $prentID = $request->root_id ? $request->root_id : $request->parent_id;
        $store->name = $request->name;
        $store->image = $request->image;
        $store->slug = $this->handlerSlug($request);
        $store->icon = $request->icon;
        $store->parent_id = $prentID;
        $store->is_active = $request->is_active;
        $store->is_searchable = $request->is_searchable;
        $store->is_featured = $request->is_featured;
        $store->short_description = $request->short_description;
        $store->description = $request->description;
        $store->breadcrumb_image = $request->breadcrumb_image;
        $store->breadcrumb_video = $breadcrumb_video;
        $store->breadcrumb_video_type =$breadcrumb_video_type;
        $store->save();

        Cache::forget('categoriesFooter');
        Cache::forget('categoriesHeader1');
        Cache::forget('categoriesHeader2');

        return $this->successResponse($store);
    }

    public function handlerSlug(Request $request)
    {
        return is_null($request->slug) ? Str::slug($request->name['en']) : $request->slug;
    }

    public function destroy($id)
    {
        $category = $this->model::findOrFail($id);
        if ($category->id === 1 || $category->slug === 'products' || $category->id === 2 || $category->slug === 'operating') {
            return $this->successResponse(false);
        }
        $category->children()->delete();
        $delete = $category->delete();

        Cache::forget('categoriesFooter');
        Cache::forget('categoriesHeader1');
        Cache::forget('categoriesHeader2');

        return $this->deleteResponse($delete);
    }

    public function getCategoryByID($id)
    {
        $category = $this->model::findOrFail($id);
        return $this->response($category);
    }
}
