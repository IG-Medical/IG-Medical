<?php


namespace Job\Http\Requests\AdminPanel;


use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [];
        foreach (languages() as $key => $value) {
            $rules['title.' . $key] = ['required', 'string'];
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = [];
        foreach (languages() as $key => $value) {
            $attributes['title.' . $key] = $value;
        }
        return $attributes;
    }
}
