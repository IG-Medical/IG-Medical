<?php


namespace Contact\Notifications;


use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class ContactUsNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    public function __construct()
    {

    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable = null)
    {
        return [
            'title' => serialize([
                'ar' => trans_module_contact_us('notification.contact_us.title', [], 'ar'),
                'en' => trans_module_contact_us('notification.contact_us.title', [], 'en'),
            ]),
            'body' => serialize([
                'ar' => trans_module_contact_us('notification.contact_us.body', [], 'ar'),
                'en' => trans_module_contact_us('notification.contact_us.body', [], 'en'),
            ]),
            'icon' => asset_app('images/logo.png'),
            'action' => 'contact-us',
            //'_type' => ADMIN_NOTIFICATION_TYPE,
        ];
    }




    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'title' => [
                'ar' => trans_module_contact_us('notification.contact_us.title', [], 'ar'),
                'en' => trans_module_contact_us('notification.contact_us.title', [], 'en'),
            ],
            'body' => [
                'ar' => trans_module_contact_us('notification.contact_us.body', [], 'ar'),
                'en' => trans_module_contact_us('notification.contact_us.body', [], 'en'),
            ],
            'icon' => asset_app('images/logo.png'),
            'action' => 'contact-us',
            'created_at' => Carbon::now(),
           // '_type' => ADMIN_NOTIFICATION_TYPE,
        ]);
    }
}
