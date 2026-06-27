<?php

namespace Contact\Mail;

use Contact\Models\ContactUs;
use Contact\Providers\AppServiceProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    private $data;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ContactUs $contactUs)
    {
        $this->data = $contactUs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = trans_module_contact_us('notification.contact_us.title');
        $product = isset($this->data->product) ? $this->data->product->name  : 'Other';
        return $this->view(AppServiceProvider::$moduleNamespace . '::.emails.contact_us', [
            'user' => 'Admin',
            '_data' => $this->data,
            'subject' => $subject,
            'product' => $product,
            'content' => trans('notifications.contact_us.create_body', [])
        ])->subject($subject);
    }
}
