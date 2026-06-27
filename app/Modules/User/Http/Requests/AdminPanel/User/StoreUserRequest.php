<?php


namespace User\Http\Requests\AdminPanel\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->id],
        ];
        if (!$this->id) {
            $rules = array_merge($rules, [
                'password' => password_rules(true, 8, true),
                'personal_photo' => ['nullable', 'string', 'max:255']
            ]);
        }
        return $rules;
    }

    private function passwordRules()
    {

    }
}
