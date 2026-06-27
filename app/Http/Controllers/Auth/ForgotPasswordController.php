<?php

namespace App\Http\Controllers\Auth;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use App\Rules\Recaptcha;
use Carbon\Carbon;
use Illuminate\Cache\RateLimiter;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends AuthController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $maxShowRecaptcha = 3;
    protected $maxThrottleMinutes = 30;

    public function __construct()
    {
        $this->middleware('guest');
      //  $this->middleware('throttle:' . $this->maxShowRecaptcha . ',' . $this->maxThrottleMinutes)->only('sendResetLinkEmail');
    }


    public function getCurrentAttempts()
    {
        $limiter = app(RateLimiter::class);
        return [
            'currentAttempts' => $limiter->hit('user'),
        ];
    }

    public function sendResetLinkEmail(Request $request, Recaptcha $recaptcha)
    {
        $validator = $this->validateForgetPassword($request->all(), $recaptcha);


        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), trans('messages.the_given_data_was_invalid'), null, [
                'currentAttempts' => $this->getCurrentAttempts()
            ]);
        }

        $user = $this->getUser();

        if (!$user) {
            $errors = ['forgot_email' => [trans('messages.error_forgot_email')]];
            $message = trans('messages.the_given_data_was_invalid');

            return $this->errorResponse($errors, $message, null, [
                'currentAttempts' => $this->getCurrentAttempts()
            ]);
        }

        $token = $this->storePasswordRest($user);

        if (!$token)
            return $this->successResponse(false);

        Mail::to($user->email)->send(new ForgotPasswordMail($user, $token));

        return $this->response(null, null, trans('messages.success_send_email'));
    }

    protected function validateForgetPassword(array $request, $recaptcha)
    {
        $getCurrentAttempts = $this->getCurrentAttempts();

        if ($getCurrentAttempts['currentAttempts'] > $this->maxShowRecaptcha)
            $recaptcha = ['required', $recaptcha];
        else
            $recaptcha = ['nullable', $recaptcha];

        return Validator::make($request, [
            'forgot_email' => 'required|email',
            'recaptcha' => ['required', $recaptcha],
        ]);

    }

    protected function getUser()
    {
        return User::select('email', 'full_name')->where('email', request('forgot_email'))->first();
    }

    protected function storePasswordRest($user)
    {
        $token = $this->token($user);
        $store = DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        return $store ? $token : false;
    }

    protected function token($user)
    {
        return $this->generateToken($user);
    }

    protected function generateToken($user)
    {
        return app('auth.password.broker')->createToken($user);
    }
}
