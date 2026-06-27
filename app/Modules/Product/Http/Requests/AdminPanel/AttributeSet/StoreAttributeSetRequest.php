<?php


namespace Product\Http\Requests\AdminPanel\AttributeSet;


use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeSetRequest extends FormRequest
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
        $rules = [];
        //$rules['attribute_set'] = ['required'];
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
