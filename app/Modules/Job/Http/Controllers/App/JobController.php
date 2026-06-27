<?php

namespace Job\Http\Controllers\App;


use Illuminate\Http\Request;
use Job\Http\Resources\AdminPanel\CareerCategoriesResources;
use Job\Http\Resources\App\CareerResources;
use Job\Models\Career;
use Job\Models\CareerCategories;


class JobController extends CoreController
{

    public function __construct(Career $career)
    {
        $this->subDirView = 'jobs';
        $this->asRoute = 'job';
        $this->route = 'jobs';
        $this->routeUrl = route_admin($this->asRoute . '.index');

        parent::__construct($career);
    }

    public function categories()
    {
        return $this->response(CareerCategoriesResources::collection(CareerCategories::getCategories()));
    }

    public function index()
    {
        meta_data(trans_module_job('app.home'), trans_module_job('app.jobs'), [
            '#' => trans_module_job('app.jobs'),
        ]);
        $pageTitle = trans_module_job('app.jobs');
        $breadcrumb = getSetting('breadcrumb_job');

        return view($this->moduleDirView . '.' . $this->subDirView . '.index', compact('pageTitle','breadcrumb'));
    }

    public function data(Request $request)
    {
        $jobs = new $this->model;
        $filter = json_decode($request->filter);
        if ($filter) {
            $category = $filter->category;
            $location = $filter->location;

            if (!empty($filter->category)) {
                $jobs = $jobs->where('category_id', 'LIKE', "%$category%");
            }
            if (!empty($filter->location)) {
                $jobs = $jobs->where('location', 'LIKE', "%$location%");
            }
        }
        $jobs = $jobs->orderBy('created_at', 'desc')->paginate(APP_PER_PAGE);
        $data = CareerResources::collection($jobs);
        $meta = collect($jobs)->except('data');

        return $this->response([
            'data' => $data,
            'meta' => $meta
        ]);
    }


    public function details($id)
    {
        $career = $this->model::where('uniq_id', getSlugId($id))->firstOrFail();

        meta_data(trans_module_job('app.home'), trans_module_job('app.home'), [
            back()->getTargetUrl() => trans_module_job('app.jobs'),
            '#' => $career->job_title,
        ]);
        $breadcrumb = getSetting('breadcrumb_job');

        $moduleNamespace = $this->moduleNamespace;
        $pageTitle = trans_module_job('app.job_details');

        return view($this->moduleDirView . '.view.index',
            compact('career', 'moduleNamespace', 'pageTitle','breadcrumb')
        );
    }
}
