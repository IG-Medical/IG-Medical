<?php


namespace Product\Http\Requests\AdminPanel\Product;


use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        $rules['category'] = ['required'];
        $rules['main_image'] = ['required'];
        $rules['image_gallery'] = ['nullable', 'array'];

        if ($this->rowsAttributes) {
            $rules['rowsAttributes.*.attribute_id'] = ['nullable'];
            $rules['rowsAttributes.*.values'] = ['nullable', 'array'];
        }


        foreach (languages() as $key => $value) {
            $rules['name.' . $key] = ['required', 'string'];
            $rules['short_description.' . $key] = ['required', 'string', 'max:200'];
            $rules['description.' . $key] = ['required', 'string'];
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = [];
        foreach (languages() as $key => $value) {
            $attributes['name.' . $key] = $value;
            $attributes['short_description.' . $key] = $value;
            $attributes['description.' . $key] = $value;
        }
        $attributes['rowsAttributes.*.attribute_id'] = trans_module_product('admin.attribute');
        $attributes['rowsAttributes.*.values'] = trans_module_product('admin.values');
        return $attributes;
    }
}
