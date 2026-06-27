<?php


namespace User\Http\Requests\AdminPanel\User;

use Illuminate\Foundation\Http\FormRequest;

class SendSMSRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rulesIDs = $this->openAdvancedSearch ? 'nullable' : 'required|array';
        return [
            'smsContent' => 'required',
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
