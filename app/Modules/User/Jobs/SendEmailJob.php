<?php


namespace User\Jobs;

use App\Mail\SendEmailToUser;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    private $users;
    private $_subject;
    private $content;

    public function __construct($users, string $subject, $content)
    {
        $this->users = $users;
        $this->_subject = $subject;
        $this->content = $content;
    }

    public function handle()
    {
        $i = 1;
        foreach ($this->users as $user) {
            try {
                Mail::to($user->email)->send(new SendEmailToUser($user, $this->_subject, $this->content));
                \Log::info("Send Email to(".$i++."): ".$user->email .' .... time: '. Carbon::now()->toDateTimeString());
            } catch (\Exception $exception) {
                \Log::info("Not Send: ".$user->email .'.... '.$exception->getMessage());
                Bugsnag::notifyException($exception);
            }
        }
    }
}
