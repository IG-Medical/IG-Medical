<?php


namespace Job\Http\Controllers\AdminPanel;


use Illuminate\Http\Request;
use Job\Http\Requests\AdminPanel\StoreCareerRequest;
use Job\Http\Resources\AdminPanel\CareerResource;
use Job\Models\Career;


class JobController extends CoreController
{

    public function __construct(Career $job)
    {
        $this->subDirView = 'jobs';
        $this->asRoute = 'job';
        $this->route = 'jobs';
        $this->routeUrl = route_admin($this->asRoute . '.index');

        parent::__construct($job);
    }

    public function index()
    {
        meta_data(trans_module_job('admin.jobs'), trans_module_job('admin.jobs'), [
            '#' => trans_module_job('admin.jobs'),
        ]);

        $singleTitle = trans_module_job('admin.job');

        $moduleNamespace = $this->moduleNamespace;
        $asRoute = $this->asRoute;
        $route = $this->route;

        return view($this->moduleDirView . '.' . $this->subDirView . '.index',
            compact('singleTitle', 'route', 'asRoute', 'moduleNamespace')
        );
    }

    public function data(Request $request)
    {
        $careers = new $this->model();
        $filter = json_decode($request->filter);

        if ($request->has('id')) {
            $careers = $careers->where('id', (int)$request->id);
        }


        if ($filter) {
            $text = $filter->text;

            if (!empty($filter->text)) {
                $careers = $careers->where('job_title', 'LIKE', "%$text%");
            }
        }

        if ($request->has('sort')) {
            $sort = json_decode($request->sort, true);
            $fieldName = isset($sort['fieldName']) && strlen($sort['fieldName']) ? $sort['fieldName'] : 'id';
            $order = $sort['order'] && strlen($sort['order']) ? $sort['order'] : 'desc';
            $careers = $careers->orderBy($fieldName, $order);
        }

        $careers = $careers->paginate(ADMIN_PER_PAGE);

        $data = CareerResource::collection($careers);
        $meta = collect($careers)->except('data');

        return response()->json(compact('data', 'meta'));
    }

    public function create()
    {
        meta_data(trans_module_job('admin.jobs'), trans_module_job('admin.jobs'), [
            $this->routeUrl => trans_module_job('admin.jobs'),
            '' => trans_module_job('admin.create') . ' ' . trans_module_job('admin.job'),
        ]);

        $route = $this->route;
        $asRoute = $this->asRoute;
        $moduleNamespace = $this->moduleNamespace;
        $genders = genders(true);

        return view($this->moduleDirView . '.' . $this->subDirView . '.create',
            compact('asRoute', 'route', 'moduleNamespace', 'genders')
        );
    }

    public function store(StoreCareerRequest $request)
    {
        $id = $request->id;
        if ($id) {
            $store = $this->model::find($id);  // edit
        } else {
            $store = new $this->model; // add
            $store->uniq_id = generateUniqid();
        }

        $store->description = $request->description;
        $store->job_title = $request->job_title;
        $store->email = $request->email;
        $store->experience = $request->experience;
        $store->gender = $request->gender;
        $store->location = $request->location;
        $store->phone = $request->phone;
        $store->status = $request->status;
        $store->category_id = $request->category_id;
        $store->deadline = $request->deadline;

        $store->save();
        return $this->successResponse($store);
    }

    public function edit($id)
    {
        meta_data(trans_module_job('admin.jobs'), trans_module_job('admin.jobs'), [
            $this->routeUrl => trans_module_job('admin.jobs'),
            '' => trans_module_job('admin.edit') . ' ' . trans_module_job('admin.job'),
        ]);

        $asRoute = $this->moduleNamespace;
        $moduleNamespace = $this->moduleNamespace;


        $getJob = $this->model::findOrFail($id);
        $job = $getJob;
        $genders = genders(true);

        return view($this->moduleDirView . '.' . $this->subDirView . '.create',
            compact('asRoute', 'job', 'moduleNamespace','genders')
        );
    }

    public function view($id)
    {
        $career = $this->model::with('applications')->findOrFail($id);

        meta_data(trans_module_job('admin.jobs'), trans_module_job('admin.jobs'), [
            $this->routeUrl => trans_module_job('admin.jobs'),
            route_admin($this->asRoute . '.index', ['id' => $career->id]) => $career->job_title,
        ]);

        $asRoute = $this->moduleNamespace;

        return view($this->moduleDirView . '.' . $this->subDirView . '.view', compact(
            'career', 'asRoute'
        ));
    }


    public function destroy($id)
    {
        $job = $this->model::findOrFail($id);
        return $this->deleteResponse($job->delete());
    }
}
