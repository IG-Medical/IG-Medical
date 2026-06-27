<?php


namespace Job\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Job\Models\CareerApplication;
use Job\Providers\AppServiceProvider;

class CareerApplicationEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    public function __construct(CareerApplication $customYourOwn)
    {
        $this->data = $customYourOwn;
    }

    public function build()
    {
        $subject = trans_module_job('app.career_application_subject'); //todo trans
        return $this->view(AppServiceProvider::$moduleNamespace . '::.emails.career-application', [
            'user' => 'Admin',
            '_data' => $this->data,
            'subject' => $subject,
            'content' => trans_module_job('app.career_application_body')  //todo trans
        ])->subject($subject);
    }
}
