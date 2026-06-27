<?php


namespace Product\Http\Controllers\AdminPanel\AttributeSets;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Product\Http\Controllers\AdminPanel\CoreController;
use Product\Http\Requests\AdminPanel\AttributeSet\StoreAttributeSetRequest;
use Product\Http\Resources\AdminPanel\AttributeSet\AttributeSetsResource;
use Product\Models\AttributeSet;
use Product\Providers\AppServiceProvider;

class AttributeSetsController extends CoreController
{
    use AttributeSetsTrait;

    public function __construct(AttributeSet $attributeSet)
    {
        $this->moduleDirView = AppServiceProvider::$moduleNamespace . '::' . ADMIN_VIEWS_DIR . '.attribute-sets';
        $this->moduleNamespace = 'attribute_set';
        $this->moduleRoute = 'attribute-sets';
        parent::__construct($attributeSet);
    }

    public function index()
    {
        meta_data(trans_module_product('admin.attribute_sets'), trans_module_product('admin.attribute_sets'), [
            '' => trans_module_product('admin.attribute_sets')
        ]);

        $singleTitle = trans_module_product('admin.attribute_set');
        $asRoute = $this->moduleNamespace;
        $moduleNamespace = AppServiceProvider::$moduleNamespace;
        $route = $this->moduleRoute;

        return view($this->moduleDirView . '.index', compact('singleTitle', 'route', 'asRoute', 'moduleNamespace'));
    }


    public function create()
    {
        meta_data(trans_module_product('admin.attribute_sets'), trans_module_product('admin.attribute_sets'), [
            route_admin('attribute_set.index') => trans_module_product('admin.attribute_sets'),
            '' => trans_module_product('admin.create') . ' ' . trans_module_product('admin.attribute_set'),
        ]);

        $singleTitle = trans_module_product('admin.attribute_set');
        $moduleNamespace = AppServiceProvider::$moduleNamespace;

        return view($this->moduleDirView . '.create', compact('moduleNamespace', 'singleTitle'));
    }

    public function data(Request $request)
    {
        $attributeSets = new $this->model();

        $attributeSets = $this->filter($request, $attributeSets);

        $attributeSets = $this->sort($request, $attributeSets);

        $attributeSets = $attributeSets->paginate(ADMIN_PER_PAGE);

        $data = AttributeSetsResource::collection($attributeSets);
        $meta = collect($attributeSets)->except('data');

        return $this->response([
            'data' => $data,
            'meta' => $meta
        ]);
    }


    public function edit($id)
    {
        meta_data(trans_module_product('admin.attribute_sets'), trans_module_product('admin.attribute_sets'), [
            route_admin('attribute_set.index') => trans_module_product('admin.attribute_sets'),
            '' => trans_module_product('admin.edit') . ' ' . trans_module_product('admin.attribute_set'),
        ]);

        $attributeSet = $this->model::findOrFail($id);
        $moduleNamespace = AppServiceProvider::$moduleNamespace;

        return view($this->moduleDirView . '.create', compact('moduleNamespace', 'attributeSet'));
    }

    public function store(StoreAttributeSetRequest $request)
    {
        $id = $request->id;

        if ($id) {
            $store = $this->model::find($id);
        } else {
            $store = new $this->model;
        }

        $store->name = $request->name;
        $store->save();
        Cache::forget('attributeSets');
        Cache::forget('getAttributeSetsWithAttribute');
        return $this->successResponse($store);
    }

    public function destroy($id)
    {
        $delete = $this->model::findOrFail($id)->delete();
        Cache::forget('attributeSets');
        Cache::forget('getAttributeSetsWithAttribute');
        return $this->deleteResponse($delete);
    }

    public function all()
    {
        $attributeSets = $this->model::getAttributeSets();
        return $this->response(AttributeSetsResource::collection($attributeSets));
    }

    public function allWithAttribute()
    {
        $attributeSets = $this->model::getAttributeSetsWithAttribute();
        return $this->response(AttributeSetsResource::collection($attributeSets));
    }
}
