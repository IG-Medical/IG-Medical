<?php


namespace Product\Http\Requests\AdminPanel\Product;


use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules['discount_percentage'] = ['nullable', 'numeric'];
        $rules['qty'] = ['nullable', 'numeric'];
        return $rules;
    }
}
