<?php

namespace Product\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Product\Models\DownloadRequestsProduct;
use Product\Models\ProductAttachments;
use Product\Providers\AppServiceProvider;

class DownloadPDFProductsMail extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    public function __construct(DownloadRequestsProduct $request)
    {
        $this->data = $request;
    }

    public function build()
    {
        $subject = trans_module_product('notifications.download_pdf_products.create_title');

        $pdf = $this->data->product->pdf_url;
    //    $pdf = assetUpload(ProductAttachments::DIR_UPLOADS . '/' . $pdf);

        return $this->view(AppServiceProvider::$moduleNamespace . '::.emails.download_pdf_products', [
            'user' => $this->data->first_name,
            '_data' => $this->data,
            'subject' => $subject,
            'content' => trans_module_product('notifications.download_pdf_products.create_body', ['pdf_url' => $pdf])
        ])->subject($subject);
    }
}
