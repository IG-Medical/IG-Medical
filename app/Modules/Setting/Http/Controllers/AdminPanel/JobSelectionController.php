<?php


namespace Setting\Http\Controllers\AdminPanel;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class JobSelectionController extends CoreController
{
//    public function __construct()
//    {
//        $this->asRoute = 'jobs_selection';
//        $this->route = 'jobs-selection';
//
//       // parent::__construct();
//    }


    public function store(Request $request)
    {
        $current_jobs = $request->current_jobs;
        $highlighted_job = $request->highlighted_jobs;
        $something_jobs = $request->something_jobs;


        $jobs = [];


        $this->model::truncate();

        if (count($current_jobs) > 0) {

            foreach ($current_jobs as $job) {
                $jobs[] = [
                    'type' => CareerSelection::CURRENT_JOBS,
                    'career_id' => $job['id'],
                ];
            }
        }

        if (count($highlighted_job) > 0) {
            foreach ($highlighted_job as $job) {
                $jobs[] = [
                    'type' => CareerSelection::HIGHLIGHTED_JOBS,
                    'career_id' => $job['id'],
                ];
            }
        }
        if (count($something_jobs) > 0) {
            foreach ($something_jobs as $job) {
                $jobs[] = [
                    'type' => CareerSelection::SOMETHING_JOB,
                    'career_id' => $job['id'],
                ];
            }
        }

        $store = $this->model::insert($jobs);

        Cache::forget('jobsSelection');

        return $this->successResponse($store);
    }
}
