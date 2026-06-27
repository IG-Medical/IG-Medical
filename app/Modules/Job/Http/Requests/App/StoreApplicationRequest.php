<?php


namespace Job\Http\Requests\App;


use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'salutation' => ['required'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255','confirmed'],
           // 'email_confirmation' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'plz' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:255'],
            'land' => ['required', 'string', 'max:255'],
            'salary_expectations' => ['required', 'string', 'max:255'],
            'place_of_residence' => ['required', 'string', 'max:255'],
            'data_protection' => ['required','boolean','in:'.true],
          //  'curriculum_vitae' => ['required'],
            'attentive_to_business_through' => ['required'],
            'file_curriculum' => ['required'],
            'earliest_start_of_work' => ['required', 'date'],
        ];
    }
}
