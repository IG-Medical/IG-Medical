<?php


namespace App\Http\Requests\AdminPanel\MyProfile;

use Illuminate\Foundation\Http\FormRequest;


class StoreBasicInfoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->id],
            'role' => ['required'],
            'personal_photo' => ['nullable', 'string', 'max:255']
        ];
    }
}
