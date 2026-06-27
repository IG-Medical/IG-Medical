<?php


namespace Slider\Http\Requests\AdminPanel\Slider;


use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
{
    private $rules = [];
    /**
     * @var mixed
     */

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $type = $this->input('type');
        if ($this->missing('type') || $type === null || $type === '') {
            $this->merge(['type' => 'web']);
            return;
        }
        $type = is_bool($type) ? 'web' : (string) $type;
        if (!in_array($type, ['web', 'mobile'], true)) {
            $type = 'web';
        }
        $this->merge(['type' => $type]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rulesImage = $this->id ? ['nullable'] : ['required'];
        return [
            'caption_1.*' => [],
            'caption_2.*' => [],
            'caption_3.*' => [],
            'background_image' => $rulesImage,
            'call_to_action_text_1.*' => [],
            'call_to_action_text_2.*' => [],
            'call_to_action_url_1' => [],
            'call_to_action_url_2' => [],
            'type' => ['required', 'string', 'in:web,mobile'],
        ];
    }
}
