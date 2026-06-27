<?php

namespace User\Http\Requests\App;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProfileRequest extends FormRequest
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
        return [
            'bio' => ['required'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->userId],
            'mobile' => ['nullable', mobile_regex(), 'max:255', 'unique:users,mobile,' . $this->userId],
            'city' => ['required'],
            'region' => ['required'],
            'personal_photo' => ['nullable'],
            'professions' => ['nullable'],
            'skills' => ['nullable','array'],
        ];
    }

}
