<?php


namespace Contact\Http\Controllers\App;



use App\Rules\Recaptcha;
use Category\Models\Category;
use Contact\Http\Requests\App\StoreContactUsRequest;
use Contact\Mail\ContactUsMail;
use Contact\Models\ContactUs;
use Contact\Notifications\ContactUsNotification;
use Contact\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Product\Models\Product;
use User\Models\User;

class ContactUSController extends CoreController
{
    public function __construct()
    {
        $this->moduleDirView = AppServiceProvider::$moduleNamespace . '::' . APP_VIEWS_DIR;
    }


    public function index()
    {
        $pageTitle = trans_module_contact_us('app.contact_us');

        meta_data($pageTitle, $pageTitle, [
            '' => $pageTitle
        ]);

        $google_map = getSetting('google_map');

        $products =    Category::whereNotNull('parent_id')->get();

        $breadcrumb = getSetting('breadcrumb_contact_us');
        return view($this->moduleDirView . '.index',
            compact('pageTitle', 'google_map', 'products','breadcrumb')
        );
    }

    public function store(StoreContactUsRequest $request, Recaptcha $recaptcha)
    {
        $store = ContactUs::create([
            'full_name' => $request->full_name,
            'company_name' => $request->company_name,
            'subject' => $request->subject,
            'email' => $request->email,
            'message' => $request->message,
            'favorite_product' => $request->favorite_product,
            'country' => $request->country,
            'phone' => $request->phone,
            'status_id' => ContactUs::STATUS_OPEN,
        ]);

        if ($store) {

            $admins = User::active()->userTypeAdmin()->get();
            Notification::send($admins, new ContactUsNotification());
            Mail::to(config('mail.emails.info'))->send(new ContactUsMail($store));
        }

        return $this->successResponse($store);
    }
}
