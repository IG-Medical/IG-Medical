<?php


namespace Testimonial\Http\Requests\AdminPanel\Testimonial;


use Illuminate\Foundation\Http\FormRequest;

class StoreTestimonialRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => ['required', 'string'],
            //'job_title' => ['required', 'string'],
            'full_name' => ['required', 'string'],
            'testimonial_text' => ['required', 'string'],
        ];
    }


}
