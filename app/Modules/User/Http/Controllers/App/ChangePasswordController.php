<?php


namespace User\Http\Controllers\App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use User\Models\User;

class ChangePasswordController extends CoreController
{

    public function __construct(User $user)
    {
        $this->subDirView = 'change-password';
        $this->asRoute = 'dashboard.showPageChangePassword';
        $this->route = 'users';

        parent::__construct($user);
    }

    public function showPageChangePassword()
    {
        $id = request()->id ? request()->id : (user() ? user()->id : null);

        if (is_null($id)) {
            return redirect()->route('index')->with('warning_message', trans('messages.is_login'));
        }

        $asRoute = $this->moduleRoute;
        $moduleName = $this->moduleNamespace;

        return view($this->moduleDirView . '.' . $this->subDirView . '.index',
            compact('asRoute', 'moduleName')
        );
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    return $fail(__(trans_module_user('app.The_current_password_is_incorrect')));
                }
            }],
            'new_password' => ['required', 'string', 'min:8'],
            'password_confirm' => ['required', 'same:new_password']
        ]);

        $user->password = Hash::make($request->get('new_password'));
        $user->save();
        return $this->successResponse($user);
    }
}
