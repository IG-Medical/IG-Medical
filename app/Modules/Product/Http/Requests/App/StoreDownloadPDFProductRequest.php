<?php


namespace Product\Http\Requests\App;


use Illuminate\Foundation\Http\FormRequest;

class StoreDownloadPDFProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return  [
            'email' => ['required', 'email', 'string'],
           // 'department' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'country_id' => ['required'],
            'first_name' => ['required', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'i_agree' => ['required'],
            'phone' => ['required'],
        ];
    }


    public function attributes()
    {
        return ['country_id' => trans_module_product('app.country')];
    }
}
