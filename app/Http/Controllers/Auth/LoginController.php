<?php

namespace App\Http\Controllers\Auth;

use User\Models\User;
use User\Models\UserStatus;
use User\Models\UserType;
use App\Rules\Recaptcha;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class LoginController extends AuthController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $maxShowRecaptcha = 3;

    public function getCurrentAttempts()
    {
        $limiter = $this->limiter();
        return [
            // gets the number of current login attempted
            'currentAttempts' => $limiter->hit('user'),

            // get the number of max attempts allowed
            'maxAttempts' => $this->maxAttempts(),

            // return 1 or 0 if current login attempts reached max attempts
            'locked' => $this->limiter()->tooManyAttempts('user', $this->maxAttempts())
        ];
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Recaptcha $recaptcha, Request $request)
    {
        $validator = $this->validateLogin($request->all(), $recaptcha);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), trans('messages.the_given_data_was_invalid'), null, [
                'currentAttempts' => $this->getCurrentAttempts()
            ]);
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $user = User::where('email', $request->email)->where('status_id', UserStatus::BLOCKED)->first();
        if (isset($user->status_id) && $user->status_id == UserStatus::BLOCKED) {
            return $this->successResponse(false, trans('messages.message_user_block'));
        }

        if (!$this->attemptLogin($request)) {
            return $this->errorResponse([], trans('auth.failed'), null, [
                'currentAttempts' => $this->getCurrentAttempts()
            ]);
        }
        return $this->sendLoginResponse($request);

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(array $request, $recaptcha)
    {
        $getCurrentAttempts = $this->getCurrentAttempts();

        if ($getCurrentAttempts['currentAttempts'] > $this->maxShowRecaptcha)
            $recaptcha = ['required', $recaptcha];
        else
            $recaptcha = ['nullable', $recaptcha];

        return Validator::make($request, [
            $this->username() => 'required|string|email',
            'log_password' => 'required|string',
            'recaptcha' => $recaptcha,
        ]);
    }

    protected function username()
    {
        return 'email';
    }

    protected function password()
    {
        return 'password';
    }

    protected function attemptLogin(Request $request)
    {

        return $this->guard()->attempt(
            array_merge($this->credentials($request), [
                'user_type_id' => UserType::CUSTOMER,
                'status_id' => UserStatus::ACCEPTED
            ]), $request->filled('remember')
        );
    }

    protected function credentials(Request $request)
    {
        return [
            $this->username() => $request->email,
            $this->password() => $request->log_password,
        ];
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user()) ?: redirect()->intended($this->redirectPath());
    }

    protected function authenticated(Request $request, $user)
    {
        $redirectTo = $this->redirectTo();

        // $message = $this->message($user);

        return response()->json([
            'status' => $user ? true : false,
            // 'message' => $message,
            'data' => ['redirectTo' => $redirectTo, 'currentAttempts' => $this->getCurrentAttempts()]
        ]);
    }


    private function message($user)
    {
        $message = $user ? trans('messages.success.login') : trans('messages.error_msg');
        return $message;
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route('app.home.index');
    }
}
