<?php


namespace App\Http\Controllers\AdminPanel\MailingList;

use App\Http\Controllers\AdminPanel\CoreController;
use App\Http\Resources\AdminPanel\MailingList\MailingListResource;
use App\Models\MailingList;
use Illuminate\Http\Request;

class MailingListController extends CoreController
{
    use MailingListTrait;

    public function __construct()
    {
//        $this->middleware('permission:index-admin|create-admin|edit-admin|delete-admin', ['only' => ['index', 'show']]);
//        $this->middleware('permission:create-admin', ['only' => ['create', 'store']]);
//        $this->middleware('permission:edit-admin', ['only' => ['edit', 'store']]);
//        $this->middleware('permission:delete-admin', ['only' => ['destroy']]);


        $this->model = MailingList::class;
        $this->asRoute = 'mailing_list';
        $this->route = route_admin('mailing_list.index');
        $this->viewPath = ADMIN_VIEWS_DIR . '.mailing-lists';
    }

    public function index()
    {
        meta_data(trans_admin('mailing_lists'), trans_admin('mailing_lists'), [
            '#' => trans_admin('mailing_lists'),
        ]);

        $asRoute = $this->asRoute;
        $singleLabel = trans_admin('admin');

        return view($this->viewPath . '.index', compact('asRoute', 'singleLabel'));
    }

    public function data(Request $request)
    {
        $emails = new $this->model();

        $emails = $this->filter($request, $emails);

        $emails = $this->sort($request, $emails);

        $emails = $emails->paginate(ADMIN_PER_PAGE);

        $data = MailingListResource::collection($emails);
        $meta = collect($emails)->except('data');

        return $this->response([
            'data' => $data,
            'meta' => $meta,
        ]);
    }

}
