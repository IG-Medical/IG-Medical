<?php


namespace Product\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Product\Models\DownloadRequestsProduct;
use Product\Providers\AppServiceProvider;

class DownloadPDFProductsToAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    public function __construct(DownloadRequestsProduct $request)
    {
        $this->data = $request;
    }

    public function build()
    {
        $subject = trans_module_product('notifications.download_pdf_products_to_admin.create_title');
        $product = $this->data->product->name;
        $country = isset($this->data->country) ? $this->data->country->name : '';
        return $this->view(AppServiceProvider::$moduleNamespace . '::.emails.download_pdf_products_to_admin', [
            'user' => $this->data->first_name,
            '_data' => $this->data,
            'subject' => $subject,
            'product' => $product,
            'country' => $country,
            'content' => trans_module_product('notifications.download_pdf_products_to_admin.create_body', [])
        ])->subject($subject);
    }
}
