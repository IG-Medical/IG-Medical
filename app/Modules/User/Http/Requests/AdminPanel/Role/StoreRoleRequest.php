<?php


namespace User\Http\Requests\AdminPanel\Role;

use Illuminate\Foundation\Http\FormRequest;


class StoreRoleRequest extends FormRequest
{

    /**
     * @var mixed
     */

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'permissions' => ['array', 'min:1']
        ];
    }
}
