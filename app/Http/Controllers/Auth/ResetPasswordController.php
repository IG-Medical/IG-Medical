<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends AuthController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $expiredMinuteURL = 60;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';
    private $isAdmin;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->isAdmin = request('isAdmin') ? true : false;
        $this->middleware('guest');
    }

    public function showResetForm($token = null)
    {
        $token = is_null($token) ? request('token') : $token;

        $data = $this->getDataOfToken($token);

        if (!$data) {
            return $this->redirectToLinkRequestForm();
        }

        if ($this->isAdmin) {
            return view(ADMIN_VIEWS_DIR . '.auth.passwords.reset', ['token' => $data->token]);
        }

        $pageTitle = trans('app.change_password');

        return view('app.auth.passwords.reset', compact('token', 'pageTitle'));
    }

    private function getDataOfToken($token)
    {
        return DB::table('password_resets')->where('token', $token)
            ->where('created_at', '>', Carbon::now()->subMinutes($this->expiredMinuteURL))
            ->latest('created_at')->first();
    }

    private function redirectToLinkRequestForm()
    {
        $error_message = trans('messages.expired_link');
        if ($this->isAdmin) {
            return redirect(route_admin('login'))->with('error_message', $error_message);
        }

        return redirect(route_app('home.index'))->with('error_message', $error_message);
    }

    public function reset()
    {
        $data = $this->getDataOfToken(request('token'));

        if (!$data) {
            return $this->redirectToLinkRequestForm();
        }

        $this->validatePassword();

        $user = $this->changePassword($data->email);

        if (!$user) {
            $this->errorResponse();
        }

        $this->deleteToken($data->email);

//        $this->loginUser($user);
//        return redirect()->intended();

        if ($this->isAdmin) {
            $redirectTo = route_admin('login');
        } else {
            $redirectTo = route_app('home.index') . '?showModalLogin=true';
        }

        return $this->response(['redirectTo' => $redirectTo], null, trans('messages.reset_password'));
    }

    private function validatePassword()
    {
        return $this->validate(request(), [
            'password' => password_rules(true, MIN_PASSWORD, true),
            'password_confirmation' => 'required|string|max:255',
        ]);
    }

    protected function changePassword($email)
    {
        $user = User::where('email', $email)->first();
        $user->password = bcrypt(request('password'));
        $user->save();
        return $user;
    }

    private function deleteToken($email)
    {
        return DB::table('password_resets')->where('email', $email)->delete();
    }

    private function loginUser($user)
    {
        return auth()->login($user);
    }

}
