<?php


namespace User\Jobs;

use App\Services\SMS;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSMSJob implements ShouldQueue
{
    private $users;
    private $_subject;
    private $content;

    public function __construct($users, $content)
    {
        $this->users = $users;
        $this->content = $content;
    }

    public function handle()
    {
        foreach ($this->users as $user) {
            try {
                $sms = new SMS();
                $sms->setMessageBody($this->content);
                $sms->setUserNumber($user->mobile);
                $sms->sendSMS();
            } catch (\Exception $exception) {
                Bugsnag::notifyException($exception);
            }
        }
    }
}
