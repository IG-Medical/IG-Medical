<?php


namespace Distributor\Http\Requests\AdminPanel\Distributor;


use Illuminate\Foundation\Http\FormRequest;

class StoreDistributorRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'image' => ['required', 'string'],
            'lat' => ['required'],
            'long' => ['required'],
            'country' => ['required'],
        ];
        foreach (languages() as $key => $value) {
            $rules['title.' . $key] = ['required', 'string'];
            $rules['description.' . $key] = ['required', 'string'];
        }
        return $rules;
    }
    public function attributes()
    {
        $attributes = [];
        foreach (languages() as $key => $value) {
            $attributes['title.' . $key] = $value;
            $attributes['description.' . $key] = $value;
        }
        return $attributes;
    }

}
