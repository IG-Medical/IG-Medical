<?php


namespace Product\Http\Controllers\App;


use App\Rules\Recaptcha;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Product\Http\Requests\App\StoreCustomizedUsRequest;
use Product\Mail\ProductsCustomizedMail;
use Product\Models\ProductsCustomized;
use Product\Notifications\ProductsCustomizedNotification;
use Product\Providers\AppServiceProvider;
use User\Models\User;

class CustomizedProductsController extends CoreController
{
    public function __construct()
    {
        $this->moduleDirView = AppServiceProvider::$moduleNamespace . '::' . APP_VIEWS_DIR;
        $this->moduleNamespace = AppServiceProvider::$moduleNamespace;
        parent::__construct();
    }

    public function index()
    {
        $pageTitle = trans_module_product('app.customized');

        meta_data(trans_module_product('app.home'), $pageTitle, [
            '' => $pageTitle,
        ]);
        $google_map = getSetting('google_map');
        $breadcrumb = getSetting('breadcrumb_customized');
        return view($this->moduleDirView . '.customized.index', compact(
            'pageTitle', 'google_map', 'breadcrumb'));
    }

    public function store(StoreCustomizedUsRequest $request, Recaptcha $recaptcha)
    {
        $store = ProductsCustomized::create([
            'full_name' => $request->full_name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'message' => $request->message,
            'product_id' => $request->product,
            'country' => $request->country,
            'phone' => $request->phone,
        ]);

        if ($store) {
            $admins = User::active()->userTypeAdmin()->get();
            Notification::send($admins, new ProductsCustomizedNotification());
            Mail::to(config('mail.emails.info'))->send(new ProductsCustomizedMail($store));
        }

        return $this->successResponse($store);
    }
}
