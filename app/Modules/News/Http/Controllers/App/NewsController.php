<?php


namespace News\Http\Controllers\App;


use News\Http\Resources\App\NewsResource;
use News\Models\News;

class NewsController extends CoreController
{

    public function index()
    {
        $pageTitle = trans_module_news('app.news');

        meta_data($pageTitle, $pageTitle, [
            '' => $pageTitle
        ]);
        $breadcrumb = getSetting('breadcrumb_news');

        return view($this->moduleDirView . '.index', compact('pageTitle','breadcrumb'));
    }

    public function data()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(APP_PER_PAGE);

        $data = NewsResource::collection($news);
        $meta = collect($news)->except('data');

        return response()->json(compact('data', 'meta'));
    }

    public function details($slug)
    {
        if (is_null($slug))
            return abort(404);

        $news = News::where("slug", $slug)->firstOrFail();

        $pageTitle = $news->title;

        if (!$news)
            return abort(404);


        meta_data($pageTitle, $pageTitle, [
            route('news.index') => trans_module_news('app.news'),
            '' => $pageTitle
        ]);
        $breadcrumb = getSetting('breadcrumb_news');

        return view($this->moduleDirView . '.details', compact('news', 'pageTitle','breadcrumb'));
    }
}
