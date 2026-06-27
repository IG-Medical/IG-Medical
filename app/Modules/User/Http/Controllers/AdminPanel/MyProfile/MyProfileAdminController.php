<?php


namespace User\Http\Controllers\AdminPanel\MyProfile;

use Illuminate\Http\Request;
use User\Http\Controllers\AdminPanel\CoreController;
use User\Http\Requests\AdminPanel\MyProfile\StoreBasicInfoRequest;
use User\Models\User;

class MyProfileAdminController extends CoreController
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function index(Request $request)
    {
        meta_data(trans_module_user('admin.profile'), trans_module_user('admin.profile'), [
            '' => trans_module_user('admin.profile'),
        ]);

        $page = $request->get('page');
        $DIR_IMAGE_UPLOADS = $this->model::DIR_IMAGE_UPLOADS;
        $admin = user();
        $asRoute = $this->moduleNamespace;

        return view($this->moduleDirView . '.my-profile.index', compact('page', 'DIR_IMAGE_UPLOADS', 'admin', 'asRoute'));
    }

    public function store(StoreBasicInfoRequest $request)
    {
        $admin = user();
        $admin->full_name = $request->first_name . ' ' . $request->last_name;
        $admin->email = $request->email;
        //$admin->role_id = $request->role;
        $admin->image = $request->personal_photo;
        $admin->save();

        $admin->assignRole([$request->role]);

        return $this->successResponse($admin);
    }
}
