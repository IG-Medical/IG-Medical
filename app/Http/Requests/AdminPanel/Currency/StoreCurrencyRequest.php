<?php


namespace App\Http\Requests\AdminPanel\Currency;


use Illuminate\Foundation\Http\FormRequest;

class StoreCurrencyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'iso' => ['required'],
            'symbol' => ['required'],
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
