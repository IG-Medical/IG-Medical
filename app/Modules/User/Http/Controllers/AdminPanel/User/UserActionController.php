<?php


namespace User\Http\Controllers\AdminPanel\User;

use User\Http\Controllers\AdminPanel\CoreController;
use User\Jobs\SendEmailJob;
use User\Jobs\SendSMSJob;
use User\Http\Requests\AdminPanel\User\SendEmailRequest;
use User\Http\Requests\AdminPanel\User\SendSMSRequest;
use User\Models\User;

class UserActionController extends CoreController
{
    use UserFilter;

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function sendEmail(SendEmailRequest $request)
    {
        $ids = $request->ids;
        $subject = $request->subject;
        $content = $request->emailContent;

        $users = new $this->model();

        if ($request->openAdvancedSearch) {
            $users = $this->filterUser($users, $request);
            $users->chunk(50, function ($users) use ($subject, $content) {
                $this->dispatch(new SendEmailJob($users, $subject, $content));
            });
        } else {
            $users->whereIn('id', $ids)->chunk(50, function ($users) use ($subject, $content) {
                $this->dispatch(new SendEmailJob($users, $subject, $content));
            });
        }

        return $this->successResponse(true);
    }

    public function sendSMS(SendSMSRequest $request)
    {
        $ids = $request->ids;
        $content = $request->smsContent;

        $users = new $this->model();

        if ($request->openAdvancedSearch) {

            $users = $this->filterUser($users, $request);

            $users->chunk(50, function ($users) use ( $content) {
                $this->dispatch(new SendSMSJob($users,  $content));
            });
        } else {
            $users->whereIn('id', $ids)->chunk(50, function ($users) use ($content) {
                $this->dispatch(new SendSMSJob($users,  $content));
            });
        }

        return $this->successResponse(true);
    }
}
