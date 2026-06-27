<?php


namespace App\Http\Requests\AdminPanel\Buyer;


use Illuminate\Foundation\Http\FormRequest;

class StoreChangePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'new_password' => ['required', 'string', 'min:8'],
            'new_password_confirm' => ['required', 'same:new_password']
        ];
    }
}
