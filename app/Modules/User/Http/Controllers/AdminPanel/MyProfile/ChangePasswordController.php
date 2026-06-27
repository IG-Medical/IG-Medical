<?php


namespace User\Http\Controllers\AdminPanel\MyProfile;


use User\Http\Controllers\AdminPanel\CoreController;
use User\Http\Requests\AdminPanel\MyProfile\StoreChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use User\Models\User;

class ChangePasswordController extends CoreController
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function update(StoreChangePasswordRequest $request)
    {
        $user = user();
        $user->password = Hash::make($request->get('new_password'));
        $user->save();

        return $this->successResponse($user);
    }
}
