<?php


namespace Product\Http\Controllers\AdminPanel\Option;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Product\Http\Controllers\AdminPanel\CoreController;
use Product\Http\Requests\AdminPanel\Option\StoreOptionRequest;
use Product\Http\Resources\AdminPanel\Option\OptionResource;
use Product\Models\Option;
use Product\Models\OptionValue;
use Product\Providers\AppServiceProvider;

class OptionController extends CoreController
{
    use OptionTrait;

    public function __construct(Option $option)
    {
        $this->moduleDirView = AppServiceProvider::$moduleNamespace . '::' . ADMIN_VIEWS_DIR . '.options';
        $this->moduleNamespace = 'option';
        $this->moduleRoute = 'options';
        parent::__construct($option);
    }

    public function index()
    {
        meta_data(trans_module_product('admin.options'), trans_module_product('admin.options'), [
            '' => trans_module_product('admin.options')
        ]);

        $singleTitle = trans_module_product('admin.option');
        $asRoute = $this->moduleNamespace;
        $moduleNamespace = AppServiceProvider::$moduleNamespace;
        $route = $this->moduleRoute;

        return view($this->moduleDirView . '.index', compact('singleTitle', 'route', 'asRoute', 'moduleNamespace'));
    }


    public function create()
    {
        meta_data(trans_module_product('admin.options'), trans_module_product('admin.options'), [
            route_admin('option.index') => trans_module_product('admin.option'),
            '' => trans_module_product('admin.create') . ' ' . trans_module_product('admin.option'),
        ]);

        $singleTitle = trans_module_product('admin.option');
        $moduleNamespace = AppServiceProvider::$moduleNamespace;

        return view($this->moduleDirView . '.create', compact('moduleNamespace', 'singleTitle'));
    }

    public function data(Request $request)
    {
        $options = new $this->model();

        $options = $this->filter($request, $options);

        $options = $this->sort($request, $options);

        $options = $options->paginate(ADMIN_PER_PAGE);

        $data = OptionResource::collection($options);
        $meta = collect($options)->except('data');

        return $this->response([
            'data' => $data,
            'meta' => $meta
        ]);
    }


    public function edit($id)
    {
        meta_data(trans_module_product('admin.options'), trans_module_product('admin.options'), [
            route_admin('option.index') => trans_module_product('admin.option'),
            '' => trans_module_product('admin.edit') . ' ' . trans_module_product('admin.option'),
        ]);

        $option = $this->model::with('values')->findOrFail($id);
        $moduleNamespace = AppServiceProvider::$moduleNamespace;

        return view($this->moduleDirView . '.create', compact('moduleNamespace', 'option'));
    }

    public function store(StoreOptionRequest $request)
    {
        $store = DB::transaction(function () use ($request) {
            $id = $request->id;

            if ($id) {
                $store = $this->model::find($id);
            } else {
                $store = new $this->model;
            }

            $store->name = $request->name;
            $store->type = $request->type;
            $store->is_global = YES;
            $store->save();

            if ($request->has('values')) {
                OptionValue::store($request->values, $store->id);
            }
            return $store;
        });

        return $this->successResponse($store);
    }

    public function destroy($id)
    {
        $delete = $this->model::findOrFail($id)->delete();
        return $this->deleteResponse($delete);
    }

}
