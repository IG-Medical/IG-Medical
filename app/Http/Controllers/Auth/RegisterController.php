<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserStatus;
use App\Models\UserType;
use App\Rules\Recaptcha;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class RegisterController extends AuthController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, ThrottlesLogins;


    // protected $redirectTo = '/home';
    protected $maxShowRecaptcha = 3;

    public function __construct()
    {
        $this->middleware('guest');
    }


//    public function maxAttempts()
//    {
//        return property_exists($this, 'maxAttempts') ? $this->maxAttempts : 5;
//    }

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


    public function register(Recaptcha $recaptcha, Request $request)
    {

        $validator = $this->validator($request->all(), $recaptcha);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), trans('messages.the_given_data_was_invalid'), null, [
                'currentAttempts' => $this->getCurrentAttempts()
            ]);
        }

        $user = $this->create($request->all());
        $this->createProfile($user);

        event(new Registered($user));


        $this->guard()->login($user);

        $redirectTo = $this->redirectTo();

        return response()->json([
            'status' => $user ? true : false,
            'data' => ['redirectTo' => $redirectTo]
        ]);
    }


    protected function validator(array $data, $recaptcha)
    {
        $getCurrentAttempts = $this->getCurrentAttempts();

        if ($getCurrentAttempts['currentAttempts'] > $this->maxShowRecaptcha)
            $recaptcha = ['required', $recaptcha];
        else
            $recaptcha = ['nullable', $recaptcha];

        if ($data['i_agree'] === false)
            unset($data['i_agree']);

        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'reg_email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => password_rules(true, 8, true),
            'i_agree' => ['required'],
            'recaptcha' => $recaptcha,
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'full_name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['reg_email'],
            'password' => Hash::make($data['password']),
            'user_type_id' => UserType::CUSTOMER,
            'status_id' => UserStatus::ACCEPTED,
        ]);
    }

    protected function createProfile($user)
    {
        return UserProfile::create([
            'user_id' => $user->id,
        ]);
    }
}
