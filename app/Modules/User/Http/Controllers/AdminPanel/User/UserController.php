<?php


namespace User\Http\Controllers\AdminPanel\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Setting\Models\BestFreelancer;
use User\Http\Controllers\AdminPanel\CoreController;
use User\Http\Requests\AdminPanel\User\StoreUserRequest;
use User\Http\Resources\AdminPanel\User\UserResource;
use User\Jobs\GivingUserAbilityToAddSpecialCareerJob;
use User\Jobs\WithdrawalUserAbilityToAddSpecialCareerJob;
use User\Models\User;
use User\Models\UserProfile;
use User\Models\UserStatus;
use User\Models\UserType;

class UserController extends CoreController
{
    use  UserTrait, UserFilter;


    public function __construct(User $user)
    {

//        $this->middleware('permission:index-admin|create-admin|edit-admin|delete-admin', ['only' => ['index', 'show']]);
//        $this->middleware('permission:create-admin', ['only' => ['create', 'store']]);
//        $this->middleware('permission:edit-admin', ['only' => ['edit', 'store']]);
//        $this->middleware('permission:delete-admin', ['only' => ['destroy']]);

        $this->subDirView = 'users';
        $this->asRoute = 'user';
        $this->route = 'users';
        $this->routeUrl = route_admin($this->asRoute . '.index');

        parent::__construct($user);
    }

    public function index()
    {
        meta_data(trans_module_user('admin.users'), trans_module_user('admin.users'), [
            '' => trans_module_user('admin.users'),
        ]);

        $singleTitle = trans_module_user('admin.user');

        $moduleNamespace = $this->moduleNamespace;

        $asRoute = $this->asRoute;
        $route = $this->route;
        $userStatus = UserStatus::getUserStatus();

        return view($this->moduleDirView . '.' . $this->subDirView . '.index',
            compact('route', 'asRoute', 'moduleNamespace', 'singleTitle', 'userStatus')
        );
    }

    public function data(Request $request)
    {
        $users = new $this->model();

        $users = $this->filterUser($users, $request);

        if ($request->has('sort')) {
            $sort = json_decode($request->sort, true);
            $fieldName = isset($sort['fieldName']) && strlen($sort['fieldName']) ? $sort['fieldName'] : 'id';
            $order = $sort['order'] && strlen($sort['order']) ? $sort['order'] : 'desc';
            $users = $users->orderBy($fieldName, $order);
        }

        $users = $users->paginate(ADMIN_PER_PAGE);
        $data = UserResource::collection($users);
        $meta = collect($users)->except('data');

        return response()->json(compact('meta', 'data'));
    }

    public function create()
    {
        $route = $this->route;
        $asRoute = $this->asRoute;

        meta_data(trans_module_user('admin.users'), trans_module_user('admin.users'), [
            $this->routeUrl => trans_module_user('admin.users'),
            '' => trans_module_user('admin.create') . ' ' . trans_module_user('admin.user'),
        ]);

        $moduleNamespace = $this->moduleNamespace;
        $DIR_IMAGE_UPLOADS = $this->model::DIR_IMAGE_UPLOADS;

        return view($this->moduleDirView . '.' . $this->subDirView . '.create',
            compact('asRoute', 'route', 'moduleNamespace', 'DIR_IMAGE_UPLOADS')
        );
    }

    public function edit($id)
    {
        $admin = $this->model::findOrFail($id);

        meta_data(trans_module_user('admin.users'), trans_module_user('admin.users'), [
            $this->routeUrl => trans_module_user('admin.users'),
            '' => trans_module_user('edit') . ' ' . trans_module_user('admin.user'),
        ]);

        $moduleNamespace = $this->moduleNamespace;
        $asRoute = $this->asRoute;
        $DIR_IMAGE_UPLOADS = $this->model::DIR_IMAGE_UPLOADS;

        return view($this->moduleDirView . '.' . $this->subDirView . '.create',
            compact('asRoute', 'admin', 'DIR_IMAGE_UPLOADS', 'moduleNamespace')
        );
    }

    public function store(StoreUserRequest $request)
    {

        $store = DB::transaction(function () use ($request) {
            $id = $request->id;

            if ($id) {
                $user = $this->model::findOrFail($id);
            } else {
                $user = new $this->model();
                $user->password = bcrypt($request->password);
                $user->uniq_id = generateUniqId();
                $user->user_type_id = UserType::NORMAL;
                $user->status_id = UserStatus::ACCEPTED;
                $user->email_verified_at = Carbon::now()->toDateTimeString();
                $user->mobile_verified_at = Carbon::now()->toDateTimeString();


            }

            $user->full_name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->image = $request->personal_photo;
            $user->mobile = $request->mobile;

            $user->save();

            if (is_null($id)) {
                UserProfile::create([
                    'user_id' => $user->id
                ]);
            }

            return $user;
        });

        return $this->successResponse($store);
    }

    public function updateSpecialJob($id)
    {
        $user = $this->model::findOrFail($id);
        $user->add_special_job = $user->add_special_job ? 0 : 1;
        $user->save();

        if ($user->add_special_job) {
            $this->dispatch(new GivingUserAbilityToAddSpecialCareerJob($user));
        } else {
            $this->dispatch(new WithdrawalUserAbilityToAddSpecialCareerJob($user));
        }
        return $this->successResponse($user);
    }

    public function destroy($id)
    {
        $user = $this->model::findOrFail($id);
        $user->update([
            'email' => time() . '_' . $user->email,
            'mobile' => time() . '_' . $user->mobile,
        ]);
        BestFreelancer::where('user_id', $user->id)->delete();
        Cache::forget('bestFreelancers');
        $delete = $user->delete();
        return $this->deleteResponse($delete);
    }
}
