<?php


namespace Product\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Product\Models\ProductsCustomized;
use Product\Providers\AppServiceProvider;

class ProductsCustomizedMail extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    public function __construct(ProductsCustomized $request)
    {
        $this->data = $request;
    }

    public function build()
    {
        $subject = trans_module_product('notifications.products_customized.title');
        $product = $this->data->product->name;

        return $this->view(AppServiceProvider::$moduleNamespace . '::.emails.products_customized', [
            'user' => $this->data->full_name,
            '_data' => $this->data,
            'subject' => $subject,
            'product' => $product,
            'content' => trans_module_product('notifications.products_customized.body', [])
        ])->subject($subject);
    }
}
