<?php


namespace User\Http\Controllers\AdminPanel\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Setting\Models\BestFreelancer;
use User\Http\Controllers\AdminPanel\CoreController;
use User\Http\Requests\AdminPanel\Admin\StoreAdminRequest;
use User\Http\Resources\AdminPanel\Admin\AdminResource;
use User\Models\User;
use User\Models\UserProfile;
use User\Models\UserStatus;
use User\Models\UserType;

class AdminController extends CoreController
{
    use AdminTrait;


    public function __construct(User $user)
    {

//        $this->middleware('permission:index-admin|create-admin|edit-admin|delete-admin', ['only' => ['index', 'show']]);
//        $this->middleware('permission:create-admin', ['only' => ['create', 'store']]);
//        $this->middleware('permission:edit-admin', ['only' => ['edit', 'store']]);
//        $this->middleware('permission:delete-admin', ['only' => ['destroy']]);

        $this->subDirView = 'admins';
        $this->asRoute = 'admin';
        $this->route = 'admins';
        $this->routeUrl = route_admin($this->asRoute . '.index');

        parent::__construct($user);
    }

    public function index()
    {
        meta_data(trans_module_user('admin.admins'), trans_module_user('admin.admins'), [
            '#' => trans_module_user('admin.users'),
            '' => trans_module_user('admin.admins'),
        ]);

        $singleTitle = trans_module_user('admin.admin');

        $moduleNamespace = $this->moduleNamespace;

        $asRoute = $this->asRoute;
        $route = $this->route;

        return view($this->moduleDirView . '.' . $this->subDirView . '.index',
            compact('route', 'asRoute', 'moduleNamespace', 'singleTitle')
        );
    }

    public function data(Request $request)
    {
        $admins = new $this->model();

        $admins = $this->filter($request, $admins);

        $admins = $this->sort($request, $admins);

        $users = $admins->userTypeAdmin()->paginate(ADMIN_PER_PAGE);

        $data = AdminResource::collection($users);
        $meta = collect($users)->except('data');

        return $this->response([
            'data' => $data,
            'meta' => $meta,
        ]);
    }

    public function create()
    {
        $route = $this->route;
        $asRoute = $this->asRoute;

        meta_data(trans_module_user('admin.admins'), trans_module_user('admin.admins'), [
            $this->routeUrl => trans_module_user('admin.admins'),
            '' => trans_module_user('admin.create') . ' ' . trans_module_user('admin.admin'),
        ]);

        $moduleNamespace = $this->moduleNamespace;
        $DIR_IMAGE_UPLOADS = $this->model::DIR_IMAGE_UPLOADS;

        return view($this->moduleDirView . '.' . $this->subDirView . '.create',
            compact('asRoute', 'route', 'moduleNamespace', 'DIR_IMAGE_UPLOADS')
        );
    }

    public function edit($id)
    {
        $moduleNamespace = $this->moduleNamespace;

        meta_data(trans_module_user('admin.admins'), trans_module_user('admin.admins'), [
            $this->routeUrl => trans_module_user('admins.admins'),
            '' => trans_module_user('admins.edit') . ' ' . trans_module_user('admin.admin'),
        ]);

        $admin = $this->model::userTypeAdmin()->findOrFail($id);

        $asRoute = $this->asRoute;
        $DIR_IMAGE_UPLOADS = $this->model::DIR_IMAGE_UPLOADS;

        return view($this->moduleDirView . '.' . $this->subDirView . '.create',
            compact('asRoute', 'admin', 'DIR_IMAGE_UPLOADS', 'moduleNamespace')
        );
    }

    public function store(StoreAdminRequest $request)
    {

        $store = DB::transaction(function () use ($request) {
            $id = $request->id;

            if ($id) {
                $admin = $this->model::findOrFail($id);
                DB::table('model_has_roles')->where('model_id', $id)->delete();
            } else {
                $admin = new $this->model();
                $admin->password = bcrypt($request->password);
                $admin->uniq_id = generateUniqId();
                $admin->user_type_id = UserType::ADMIN;
                $admin->status_id = UserStatus::ACCEPTED;
                $admin->email_verified_at = Carbon::now()->toDateTimeString();
                $admin->mobile_verified_at = Carbon::now()->toDateTimeString();

                UserProfile::create([
                    'user_id' => $admin->id,
                ]);
            }

            $admin->full_name = $request->first_name . ' ' . $request->last_name;
            $admin->email = $request->email;
            $admin->image = $request->personal_photo;
            $admin->role_id = $request->role;
            $admin->save();


            $admin->assignRole($request->input('role'));

            return $admin;
        });

        return $this->successResponse($store);
    }

    public function destroy($id)
    {
        $delete = $this->model::findOrFail($id)->delete();
        BestFreelancer::where('user_id',$id)->delete();
        Cache::forget('bestFreelancers');
        return $this->deleteResponse($delete);
    }
}
