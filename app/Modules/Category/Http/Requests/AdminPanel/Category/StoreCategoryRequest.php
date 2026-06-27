<?php


namespace Category\Http\Requests\AdminPanel\Category;


use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $ruleImageRequired = $this->is_featured ? 'required' : 'nullable';
        $rules = [
            'icon' => ['nullable', 'string'],
            'image' => [$ruleImageRequired, 'string'],
            'parent_id' => ['nullable'],
        ];
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
