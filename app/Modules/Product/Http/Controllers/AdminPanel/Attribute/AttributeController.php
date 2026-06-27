<?php


namespace Product\Http\Controllers\AdminPanel\Attribute;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Product\Http\Controllers\AdminPanel\CoreController;
use Product\Http\Requests\AdminPanel\Attribute\StoreAttributeRequest;
use Product\Http\Resources\AdminPanel\Attribute\AttributeResource;
use Product\Models\Attribute;
use Product\Models\AttributeValue;
use Product\Providers\AppServiceProvider;

class AttributeController extends CoreController
{
    use AttributeTrait;

    public function __construct(Attribute $attribute)
    {
        $this->moduleDirView = AppServiceProvider::$moduleNamespace . '::' . ADMIN_VIEWS_DIR . '.attributes';
        $this->moduleNamespace = 'attribute';
        $this->moduleRoute = 'attributes';
        parent::__construct($attribute);
    }

    public function index()
    {
        meta_data(trans_module_product('admin.attributes'), trans_module_product('admin.attributes'), [
            '' => trans_module_product('admin.attributes')
        ]);

        $singleTitle = trans_module_product('admin.attribute');
        $asRoute = $this->moduleNamespace;
        $moduleNamespace = AppServiceProvider::$moduleNamespace;
        $route = $this->moduleRoute;

        return view($this->moduleDirView . '.index', compact('singleTitle', 'route', 'asRoute', 'moduleNamespace'));
    }


    public function create()
    {
        meta_data(trans_module_product('admin.attributes'), trans_module_product('admin.attributes'), [
            route_admin('attribute.index') => trans_module_product('admin.attributes'),
            '' => trans_module_product('admin.create') . ' ' . trans_module_product('admin.attribute'),
        ]);

        $singleTitle = trans_module_product('admin.attribute');
        $moduleNamespace = AppServiceProvider::$moduleNamespace;

        return view($this->moduleDirView . '.create', compact('moduleNamespace', 'singleTitle'));
    }

    public function data(Request $request)
    {
        $attributeSets = new $this->model();

        $attributeSets = $this->filter($request, $attributeSets);

        $attributeSets = $this->sort($request, $attributeSets);

        $attributeSets = $attributeSets->with('attributeSet')->paginate(ADMIN_PER_PAGE);

        $data = AttributeResource::collection($attributeSets);
        $meta = collect($attributeSets)->except('data');

        return $this->response([
            'data' => $data,
            'meta' => $meta
        ]);
    }


    public function edit($id)
    {
        meta_data(trans_module_product('admin.attributes'), trans_module_product('admin.attributes'), [
            route_admin('attribute.index') => trans_module_product('admin.attributes'),
            '' => trans_module_product('admin.edit') . ' ' . trans_module_product('admin.attribute'),
        ]);

        $attribute = $this->model::with('values')->findOrFail($id);
        $moduleNamespace = AppServiceProvider::$moduleNamespace;

        return view($this->moduleDirView . '.create', compact('moduleNamespace', 'attribute'));
    }

    public function store(StoreAttributeRequest $request)
    {
        $store = DB::transaction(function () use ($request) {
            $id = $request->id;

            if ($id) {
                $store = $this->model::find($id);
            } else {
                $store = new $this->model;
            }

            $store->name = $request->name;
            $store->attribute_set_id = $request->attribute_set;
            $store->save();

            if ($request->has('values')) {
                AttributeValue::store($request->values, $store->id);
            }
            return $store;
        });
        Cache::forget('attributes');

        return $this->successResponse($store);
    }

    public function all()
    {
        $data = $this->model::getAttributesAll();
        return $this->response($data);
    }

    public function destroy($id)
    {
        $delete = $this->model::findOrFail($id)->delete();
        Cache::forget('attributes');
        return $this->deleteResponse($delete);
    }

}
