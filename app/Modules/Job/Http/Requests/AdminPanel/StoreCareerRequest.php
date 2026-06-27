<?php


namespace Job\Http\Requests\AdminPanel;


use Illuminate\Foundation\Http\FormRequest;

class StoreCareerRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'email' => ['required'],
            'phone' => ['required'],
            'gender' => ['required'],
        ];

        foreach (languages() as $key => $value) {
            $rules['job_title.' . $key] = ['required', 'string'];
            $rules['description.' . $key] = ['required', 'string'];
            $rules['experience.' . $key] = ['required', 'string'];
            $rules['location.' . $key] = ['required', 'string'];
            $rules['status.' . $key] = ['required', 'string'];
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = [];
        foreach (languages() as $key => $value) {
            $attributes['job_title.' . $key] = $value;
            $attributes['description.' . $key] = $value;
            $attributes['experience.' . $key] = $value;
            $attributes['location.' . $key] = $value;
            $attributes['status.' . $key] = $value;
        }
        return $attributes;
    }
}
