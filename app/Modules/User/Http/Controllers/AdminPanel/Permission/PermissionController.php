<?php


namespace User\Http\Controllers\AdminPanel\Permission;


use User\Http\Resources\AdminPanel\Permission\PermissionResource;
use User\Models\Permission;
use User\Http\Controllers\AdminPanel\CoreController;

class PermissionController extends CoreController
{

    public function __construct()
    {
       // $this->middleware('permission:index-permission', ['only' => ['index']]);

        $this->model = Permission::class;
        $this->viewPath = ADMIN_VIEWS_DIR . '.roles';
    }

    public function index()
    {
        meta_data(trans('admin.permissions'), trans('admin.permissions'), [
            '#' => trans('admin.users'),
            '' =>trans('admin.permissions'),
        ]);

        return view('admin_panel.permissions.index');
    }

    public function all()
    {
        return $this->response(PermissionResource::collection($this->model::with('group')->get()));
    }
}
