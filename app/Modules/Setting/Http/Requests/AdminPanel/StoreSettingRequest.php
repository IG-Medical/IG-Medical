<?php


namespace Setting\Http\Requests\AdminPanel;


use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
{
    private $rules = [];

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
        // dd($this->all());
        if ($this->page === PAGE_CUSTOM_CSS_JS) {
            $this->rulesCustomCSSANDJS();
        }

        if ($this->page === PAGE_SOCIAL_MEDIA_LINKS) {
            $this->rulesSocialMediaLinks();
        }

        if ($this->page === PAGE_CONTACT_INFO) {
            $this->rulesContactInfo();
        }

        if ($this->page === PAGE_GENERAL) {
            $this->rulesGeneralAppearance();
        }

        if ($this->page === 'mail') {
            $this->rulesMailAppearance();
        }

        if ($this->page === 'features') {
            $this->ruleFeaturesAppearance();
        }

        if ($this->page === PAGE_HOME_PAGE) {
            $this->ruleVideoHowItWorksAppearance();
        }

        return $this->rules;
    }

    private function rulesMailAppearance()
    {
        $this->rules['mail_from_name'] = ['required', 'string'];
        $this->rules['mail_from_address'] = ['required', 'email'];
        $this->rules['mail_host'] = ['required'];
        $this->rules['mail_port'] = ['required'];
        $this->rules['mail_username'] = ['required'];
        $this->rules['mail_password'] = ['required'];
        $this->rules['mail_encryption'] = ['nullable', 'in:ssl,tls'];
    }

    private function ruleFeaturesAppearance()
    {
        // $this->rules['mail_from_name'] = ['dimensions:max_width=20,max_height=20'];
    }

    private function rulesGeneralAppearance()
    {
        $this->rules['welcome_text'] = ['nullable'];
        $this->rules['site_name'] = ['nullable'];
        $this->rules['slider_video'] = [
            'nullable',
            'file',
            'mimetypes:video/mp4,video/webm,video/ogg',
            'max:307200', // 300MB in KB
            ];
    }   

    private function rulesCustomCSSANDJS()
    {
        $this->rules['header'] = ['nullable'];
        $this->rules['footer'] = ['nullable'];
    }

    private function rulesContactInfo()
    {
        $this->rules['email'] = ['nullable', 'email'];
        $this->rules['phone'] = ['nullable', 'string'];
        $this->rules['global_website'] = ['nullable','url'];

    }

    private function rulesSocialMediaLinks()
    {
        $this->rules['facebook'] = ['nullable', 'url'];
        $this->rules['twitter'] = ['nullable', 'url'];
        $this->rules['youtube'] = ['nullable', 'url'];
        $this->rules['instagram'] = ['nullable', 'url'];
        $this->rules['linkedin'] = ['nullable', 'url'];
    }

    private function ruleVideoHowItWorksAppearance()
    {
        $this->rules['video_how_it_works'] = ['nullable', 'url'];
    }
}
