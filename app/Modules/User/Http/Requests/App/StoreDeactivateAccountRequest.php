<?php


namespace User\Http\Requests\App;


use Illuminate\Foundation\Http\FormRequest;

class StoreDeactivateAccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

        ];
    }

}
