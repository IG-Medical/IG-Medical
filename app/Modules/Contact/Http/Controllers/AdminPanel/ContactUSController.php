<?php


namespace Contact\Http\Controllers\AdminPanel;

use Contact\Http\Resources\AdminPanel\ContactUS\ContactUsResource;
use Contact\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUSController extends CoreController
{
    use ContactUSTrait;

    public function __construct(ContactUs $contact)
    {
        parent::__construct($contact);
    }

    public function index()
    {
        meta_data(trans_module_contact_us('admin.contact_us'), trans_module_contact_us('admin.contact_us'), [
            '' => trans_module_contact_us('admin.contact_us')
        ]);

        $asRoute = $this->moduleNamespace;
        $route = $this->moduleRoute;

        return view($this->moduleDirView . '.index', compact('route', 'asRoute'));
    }


    public function data(Request $request)
    {
        $message = new $this->model();

        $message = $this->filter($request, $message);

        $message = $this->sort($request, $message);

        if ($request->has('status')) {
            $message->where('status_id', ContactUs::STATUS_ARCHIVED);
        } else {
            $message->where('status_id', ContactUs::STATUS_OPEN);
        }

        $message = $message->with('product')->paginate(ADMIN_PER_PAGE);

        $data = ContactUsResource::collection($message);
        $meta = collect($message)->except('data');

        return $this->response([
            'data' => $data,
            'meta' => $meta
        ]);
    }

    public function archive($id)
    {
        $contact = $this->model::findorfail($id);
        $contact->update(['status_id' => ContactUs::STATUS_ARCHIVED]);
        return $this->successResponse($contact);
    }
}
