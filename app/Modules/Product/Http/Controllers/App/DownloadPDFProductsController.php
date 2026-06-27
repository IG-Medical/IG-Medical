<?php


namespace Product\Http\Controllers\App;


use Illuminate\Support\Facades\Mail;
use Product\Http\Requests\App\StoreDownloadPDFProductRequest;
use Product\Mail\DownloadPDFProductsMail;
use Product\Mail\DownloadPDFProductsToAdminMail;
use Product\Mail\RequestApprovalDownloadFileMail;
use Product\Models\DownloadRequestsProduct;
use Product\Providers\AppServiceProvider;

class DownloadPDFProductsController extends CoreController
{
    public function __construct()
    {
        $this->moduleDirView = AppServiceProvider::$moduleNamespace . '::' . APP_VIEWS_DIR;
        $this->moduleNamespace = AppServiceProvider::$moduleNamespace;
        parent::__construct();
    }

    public function store(StoreDownloadPDFProductRequest $request)
    {

        $setting = getSetting('product_pdf');

        if ($setting == 1) {
            $store = DownloadRequestsProduct::create([
                'phone' => $request->phone,
                'email' => $request->email,
                'department' => $request->department,
                'company' => $request->company,
                'first_name' => $request->first_name,
                'surname' => $request->surname,
                'product_id' => $request->product_id,
                'country_id' => isset($request->country_id['id']) ? $request->country_id['id'] : null,
                'status' => (string)YES,
            ]);
            if ($store) {
                Mail::to($request->email)->send(new DownloadPDFProductsMail($store));
                Mail::to(config('app.emails.info'))->send(new DownloadPDFProductsToAdminMail($store));
            }

        } else {
            $store = DownloadRequestsProduct::create([
                'phone' => $request->phone,
                'email' => $request->email,
                'department' => $request->department,
                'company' => $request->company,
                'first_name' => $request->first_name,
                'surname' => $request->surname,
                'status' => (string)NO,
                'country_id' => isset($request->country_id['id']) ? $request->country_id['id'] : null,
                'product_id' => $request->product_id,
            ]);
            Mail::to(config('app.emails.info'))->send(new RequestApprovalDownloadFileMail($store));
        }
        return $this->successResponse($store);
    }
}
