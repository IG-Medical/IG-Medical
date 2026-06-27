<?php


namespace User\Http\Requests\AdminPanel\User;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rulesIDs = $this->openAdvancedSearch ? 'nullable' : 'required|array';
        return [
            'subject' => 'required',
            'emailContent' => 'required',
            'ids' => $rulesIDs,
        ];
    }

    public function attributes()
    {
        return [
            'ids' => 'users'
        ];
    }
}
