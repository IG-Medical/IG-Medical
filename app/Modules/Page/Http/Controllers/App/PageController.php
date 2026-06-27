<?php


namespace Page\Http\Controllers\App;


use Page\Models\Page;

class PageController extends CoreController
{

    public function __invoke($slug)
    {
        if (is_null($slug))
            return abort(404);

        $page = Page::where("slug", $slug)->first();

        if (!$page)
            return abort(404);


        $pageTitle = $page->title;

        meta_data($pageTitle, $pageTitle, [
            '' => $pageTitle
        ]);

        $breadcrumb = getSetting('breadcrumb_public_page');


        if ($slug === 'sales') {
            $breadcrumb = getSetting('breadcrumb_sales');
        }
        if ($slug === 'technical') {
            $breadcrumb = getSetting('breadcrumb_technical');
        }
        return view($this->moduleDirView . '.index', compact('page', 'slug', 'pageTitle', 'breadcrumb'));
    }
}
