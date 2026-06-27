<?php


namespace Contact\Http\Requests\App;


use App\Rules\Recaptcha;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactUsRequest extends FormRequest
{
    private $recaptcha;


    public function authorize(Recaptcha $recaptcha)
    {
        $this->recaptcha = $recaptcha;

        return true;
    }

    public function rules()
    {
        return  [
            'email' => ['required', 'email', 'string'],
            'full_name' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'phone' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'subject' => ['nullable'],
            'favorite_product' => ['required'],
            'recaptcha' => ['required', $this->recaptcha],
        ];
    }
}
