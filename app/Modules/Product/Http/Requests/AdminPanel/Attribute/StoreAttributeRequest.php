<?php


namespace Product\Http\Requests\AdminPanel\Attribute;


use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeRequest extends FormRequest
{

    /**
     * @var mixed
     */

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules['attribute_set'] = ['required'];


        foreach (languages() as $key => $value) {
            $rules['name.' . $key] = ['required', 'string'];
            $rules['values.*.name.' . $key] = ['required'];
        }
        return $rules;
    }

    public function attributes()
    {
        $attributes = [];
        foreach (languages() as $key => $value) {
            $attributes['name.' . $key] = trans_module_product('admin.name').' '.$value;
            $attributes['values.*.name.' . $key] = trans_module_product('admin.value').' '.$value;
        }
        return $attributes;
    }
}
