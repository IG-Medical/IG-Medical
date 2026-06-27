<?php


namespace App\Http\Requests\AdminPanel\MyProfile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class StoreChangePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $user = user();
        return [
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    return $fail(__(trans('app.The_current_password_is_incorrect')));
                }
            }],
            'new_password' => ['required', 'string', 'min:8'],
            'new_password_confirm' => ['required', 'same:new_password']
        ];
    }
}
