<?php


namespace Product\Http\Requests\AdminPanel\Option;


use Illuminate\Foundation\Http\FormRequest;

class StoreOptionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules['type'] = ['required'];
        foreach (languages() as $key => $value) {
            $rules['name.' . $key] = ['required', 'string'];
        }
        return $rules;
    }

    public function attributes()
    {
        $attributes = [];
        foreach (languages() as $key => $value) {
            $attributes['name.' . $key] = $value;
        }
        return $attributes;
    }
}
