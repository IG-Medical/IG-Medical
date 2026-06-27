<?php


namespace News\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use News\Http\Requests\AdminPanel\StoreNewsRequest;
use News\Http\Resources\AdminPanel\NewsResource;
use News\Models\News;

class NewsController extends CoreController
{
    use NewsTrait;

    public function __construct(News $page)
    {
        parent::__construct($page);
    }

    public function index()
    {

        meta_data(trans_module_news('admin.news'), trans_module_news('admin.news'), [
            '' => trans_module_news('admin.news')
        ]);

        $singleTitle = trans_module_news('admin.news');
        $asRoute = $this->moduleNamespace;
        $route = $this->moduleRoute;
        return view($this->moduleDirView . '.index', compact('singleTitle', 'route', 'asRoute'));
    }

    public function data(Request $request)
    {

        $news = new $this->model();

        $news = $this->filter($request, $news);
        $news = $this->sort($request, $news);
        $news = $news->paginate(ADMIN_PER_PAGE);

        $data = NewsResource::collection($news);
        $meta = collect($news)->except('data');

        return response()->json(compact('data', 'meta'));
    }

    public function create()
    {
        meta_data(trans_module_news('admin.news'), trans_module_news('admin.news'), [
            route_admin('news.index') => trans_module_news('admin.news'),
            '' => trans_module_news('admin.create') . ' ' . trans_module_news('admin.news'),
        ]);

        $asRoute = $this->moduleNamespace;
        $DIR_UPLOADS = News::DIR_UPLOADS;
        return view($this->moduleDirView . '.create', compact('asRoute','DIR_UPLOADS'));
    }

    public function store(StoreNewsRequest $request)
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
        $store->short_content = $request->short_content;
        $store->image = $request->image;
        $store->save();


        return $this->successResponse($store);
    }

    public function edit($id)
    {

        $asRoute = $this->moduleNamespace;

        meta_data(trans_module_news('admin.news'), trans_module_news('admin.news'), [
            route_admin('news.index') => trans_module_news('admin.news'),
            '' => trans_module_news('admin.edit') . ' ' . trans_module_news('admin.news'),
        ]);

        $news = $this->model::find($id);
        $DIR_UPLOADS = News::DIR_UPLOADS;

        return view($this->moduleDirView . '.create', compact('asRoute', 'news','DIR_UPLOADS'));
    }

    public function destroy($id)
    {
        $delete = $this->model::findOrFail($id)->delete();
        return $this->deleteResponse($delete);
    }


    public function handlerSlug(Request $request)
    {
        return is_null($request->slug) ? Str::slug($request->title[getAppLocale()]) : $request->slug;
    }

}
