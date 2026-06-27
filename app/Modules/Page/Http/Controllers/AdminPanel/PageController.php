<?php


namespace Page\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Page\Http\Requests\AdminPanel\StorePageRequest;
use Page\Http\Resources\AdminPanel\PageResource;
use Page\Models\Page;

class PageController extends CoreController
{
    use PageTrait;

    public function __construct(Page $page)
    {
        parent::__construct($page);
    }

    public function index()
    {

        meta_data(trans_module_page('admin.pages'), trans_module_page('admin.pages'), [
            '' => trans_module_page('admin.pages')
        ]);

        $singleTitle = trans_module_page('admin.page');
        $asRoute = $this->moduleNamespace;
        $route = $this->moduleRoute;
        return view($this->moduleDirView . '.index', compact('singleTitle', 'route', 'asRoute'));
    }

    public function data(Request $request)
    {

        $pages = new $this->model();

        $pages = $this->filter($request, $pages);
        $pages = $this->sort($request, $pages);
        $pages = $pages->paginate(ADMIN_PER_PAGE);

        $data = PageResource::collection($pages);
        $meta = collect($pages)->except('data');

        return response()->json(compact('data', 'meta'));
    }

    public function create()
    {
        meta_data(trans_module_page('admin.pages'), trans_module_page('admin.pages'), [
            route_admin('page.index') => trans_module_page('admin.pages'),
            '' => trans_module_page('admin.create') . ' ' . trans_module_page('admin.page'),
        ]);

        $asRoute = $this->moduleNamespace;

        return view($this->moduleDirView . '.create', compact('asRoute'));
    }

    public function store(StorePageRequest $request)
    {

        $id = $request->id;

        $slug = $this->handlerSlug($request);

        if ($id)
            $store = $this->model::find($id);  // edit
        else
            $store = new $this->model; // add

        $store->title = $request->title;
        $store->slug = $slug;
        $store->content = $request->pContent;
        $store->save();

        Cache::forget('pages');

        return $this->successResponse($store);
    }

    public function edit($id)
    {

        $asRoute = $this->moduleNamespace;

        meta_data(trans_module_page('admin.pages'), trans_module_page('admin.pages'), [
            route_admin('page.index') => trans_module_page('admin.pages'),
            '' => trans_module_page('admin.edit') . ' ' . trans_module_page('admin.page'),
        ]);


        $page = $this->model::find($id);

        return view($this->moduleDirView . '.create', compact('asRoute', 'page'));
    }

    public function destroy($id)
    {
        $delete = $this->model::findOrFail($id)->delete();
        return $this->deleteResponse($delete);
    }


    public function handlerSlug(Request $request)
    {
        return is_null($request->slug) ? slugify($request->title[getAppLocale()]) : $request->slug;
    }

}
