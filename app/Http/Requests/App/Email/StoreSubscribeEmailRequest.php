<?php


namespace App\Http\Requests\App\Email;


use Illuminate\Foundation\Http\FormRequest;

class StoreSubscribeEmailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email', 'unique:mailing_lists,email,'],
            'full_name' => ['required'],
            'agree' => ['required'],
        ];
    }
}
