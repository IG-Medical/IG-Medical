<?php


namespace User\Http\Controllers\AdminPanel\Role;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use User\Http\Controllers\AdminPanel\CoreController;
use User\Http\Requests\AdminPanel\Role\StoreRoleRequest;
use User\Models\Role as Model;

class RoleController extends CoreController
{
    use RoleTrait;

    protected $route;

    public function __construct(Model $role)
    {
//        $this->middleware('permission:index-role|create-role|edit-role|delete-role', ['only' => ['index', 'show']]);
//        $this->middleware('permission:create-role', ['only' => ['create', 'store']]);
//        $this->middleware('permission:edit-role', ['only' => ['edit', 'store']]);
//        $this->middleware('permission:delete-role', ['only' => ['destroy']]);

        $this->subDirView = 'roles';
        $this->asRoute = 'role';
        $this->route = 'roles';
        $this->routeUrl = route_admin($this->asRoute . '.index');

        parent::__construct($role);
    }

    public function index()
    {
        meta_data(trans_module_user('admin.roles'), trans_module_user('admin.roles'), [
            $this->routeUrl => trans_module_user('admin.users'),
            '' => trans_module_user('admin.roles'),
        ]);

        $moduleNamespace = $this->moduleNamespace;

        $singleTitle = trans_module_user('admin.role');

        $asRoute = $this->asRoute;

        $route = $this->route;

        return view($this->moduleDirView . '.' . $this->subDirView . '.index',
            compact('asRoute', 'singleTitle', 'route', 'moduleNamespace')
        );
    }

    public function data(Request $request)
    {

        $roles = new $this->model();

        $roles = $roles->select('id', 'name', 'created_at');

        $roles = $this->filter($request, $roles);

        $roles = $this->sort($request, $roles);

        $roles = $roles->paginate(ADMIN_PER_PAGE);

        return $this->response($roles);
    }

    public function create()
    {
        $route = $this->route;
        $asRoute = $this->asRoute;
        $moduleNamespace = $this->moduleNamespace;

        meta_data(trans_module_user('admin.roles'), trans_module_user('admin.roles'), [
            $this->routeUrl => trans_module_user('admin.roles'),
            '' => trans_module_user('admin.create') . ' ' . trans_module_user('admin.role'),
        ]);

        $roles = Model::getAllWithPermissions();

        return view($this->moduleDirView . '.' . $this->subDirView . '.create',
            compact('roles', 'asRoute', 'route', 'moduleNamespace')
        );
    }

    public function edit($id)
    {
        $moduleNamespace = $this->moduleNamespace;

        meta_data(trans_module_user('admin.roles'), trans_module_user('admin.roles'), [
            $this->routeUrl => trans('admin.roles'),
            '' => trans_module_user('admin.edit') . ' ' . trans_module_user('admin.role'),
        ]);

        $roles = Model::getAllWithPermissions();
        $role = $this->model::with('permissions')->where('id', $id)->firstOrFail();


        $asRoute = $this->asRoute;

        return view($this->moduleDirView . '.' . $this->subDirView . '.create',
            compact('roles', 'asRoute', 'role', 'moduleNamespace')
        );
    }

    public function store(StoreRoleRequest $request)
    {
        $store = DB::transaction(function () use ($request) {
            $id = $request->id;

            if ($id) {
                $role = Role::findOrFail($id);
            } else {
                $role = new Role();
            }

            $role->name = $request->name;
            $role->guard_name = config('auth.defaults.guard');
            $role->save();

            if ($request->has('permissions'))
                $role->syncPermissions($request->permissions);

            return $role;
        });

        Cache::forget('rolesWithPermissions');

        return $this->successResponse($store);
    }

    public function destroy($id)

    {
        $delete = Role::findOrFail($id)->delete();

        Cache::forget('rolesWithPermissions');

        return $this->deleteResponse($delete);
    }

    public function all()
    {
        return $this->response($this->model::getAll());
    }
}
