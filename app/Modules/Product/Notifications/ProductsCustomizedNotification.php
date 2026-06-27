<?php


namespace Product\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notification;

class ProductsCustomizedNotification extends Notification implements ShouldBroadcast
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
                'ar' => trans_module_product('notification.contact_us.title', [], 'ar'),
                'en' => trans_module_product('notification.contact_us.title', [], 'en'),
            ]),
            'body' => serialize([
                'ar' => trans_module_product('notification.contact_us.body', [], 'ar'),
                'en' => trans_module_product('notification.contact_us.body', [], 'en'),
            ]),
            'icon' => asset_app('images/logo.png'),
            'action' => '',
            //'_type' => ADMIN_NOTIFICATION_TYPE,
        ];
    }

}
