<?php


namespace User\Http\Controllers\App;


use Illuminate\Http\Request;
use User\Http\Resources\App\UserFilterResource;
use User\Models\User;
use User\Models\UserStatus;
use User\Models\UserType;

class UserController extends CoreController
{
    public function __construct(User $model)
    {
        $this->subDirView = 'users';
        $this->asRoute = 'user';
        $this->route = 'users';
        // $this->routeUrl = route_app($this->asRoute . '.index');

        parent::__construct($model);
    }

    public function index()
    {
        meta_data(trans_module_user('app.home'), trans_module_user('app.home'), [
            '#' => trans_module_user('app.retirees'),
        ]);

        $pageTitle = trans_module_user('app.retirees');
        $moduleNamespace = $this->moduleNamespace;
        $search = request('search');
        return view($this->moduleDirView . '.' . $this->subDirView . '.search',
            compact('pageTitle', 'moduleNamespace', 'search')
        );
    }

    public function data(Request $request)
    {
        $sort = $request->sort;
        $fieldName = $sort ? $sort : 'id';
        $order = $request->has('order_by') ? $request->order_by : 'desc';

        $freelancers = new $this->model;

        if ($request->has('filter')) {

            $filter = json_decode($request->filter);

            if ($filter->name) {
                $freelancers = $freelancers->where('full_name', 'LIKE', "%$filter->name%");
            }

            if ($filter->professions) {
                $freelancers = $freelancers->whereHas('profile', function ($query) use ($filter) {
                    $query->whereIn('profession_id', collect($filter->professions)->map(function ($q) {
                        return $q->id;
                    }));
                });
            }

            if ($filter->skills) {
                $freelancers = $freelancers->whereHas('skills', function ($query) use ($filter) {
                    $query->whereIn('skills.id', collect($filter->skills)->map(function ($q) {
                        return $q->id;
                    }));
                });
            }

            if ($filter->region || $filter->city) {
                $freelancers = $freelancers->whereHas('profile', function ($q) use ($filter) {
                    if ($filter->region)
                        $q->whereIn('region_id', [$filter->region]);
                    if ($filter->city)
                        $q->whereIn('city_id', [$filter->city]);
                });
            }
        }

        if ($request->has('sort') && !is_null($request->sort)) {
            $freelancers = $freelancers->orderBy($fieldName, $order);
        }

        if (user()) {
            $freelancers = $freelancers->where('users.id', '!=', user()->id)->where('appear_on_the_retired_page', YES);
        }


        $limit = $request->has('limit') ? $request->limit : APP_PER_PAGE;

        $freelancers = $freelancers->where('user_type_id', UserType::NORMAL)
            ->where('status_id', UserStatus::ACCEPTED)
            ->with('skills', 'profile.region', 'profile.salaryRange')->paginate($limit);

        $meta = collect($freelancers)->except('data');
        $data = UserFilterResource::collection($freelancers);

        return response()->json(compact('data', 'meta'));
    }
}
