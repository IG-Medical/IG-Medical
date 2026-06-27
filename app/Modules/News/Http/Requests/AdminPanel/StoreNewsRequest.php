<?php

namespace News\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        foreach (languages() as $key => $value) {
            $rules['title.' . $key] = ['required', 'string'];
            $rules['pContent.' . $key] = ['required', 'string'];
            $rules['short_content.' . $key] = ['required', 'string'];
        }
        return $rules;
    }

    public function attributes()
    {
        $attributes = [];
        foreach (languages() as $key => $value) {
            $attributes['title.' . $key] = $value;
            $attributes['pContent.' . $key] = $value;
            $attributes['short_content.' . $key] = $value;
        }
        return $attributes;
    }
}
