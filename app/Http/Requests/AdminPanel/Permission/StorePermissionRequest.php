<?php


namespace App\Http\Requests\AdminPanel\Permission;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

        ];
    }
}
