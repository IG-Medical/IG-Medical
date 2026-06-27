<?php


namespace Job\Http\Controllers\AdminPanel;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Job\Http\Requests\AdminPanel\StoreCategoryRequest;
use Job\Http\Resources\AdminPanel\CareerCategoriesResources;
use Job\Http\Resources\AdminPanel\CategoryResource;
use Job\Models\CareerCategories;

class CategoryJobController extends CoreController
{
    public function __construct(CareerCategories $category)
    {
        $this->subDirView = 'categories';
        $this->asRoute = 'job.category';
        $this->route = 'categories';
        $this->routeUrl = route_admin($this->asRoute . '.index');

        parent::__construct($category);
    }

    public function index()
    {
        meta_data(trans_module_job('admin.categories'), trans_module_job('admin.categories'), [
            '#' => trans_module_job('admin.categories'),
        ]);

        $singleTitle = trans_module_job('admin.category');

        $moduleNamespace = $this->moduleNamespace;
        $asRoute = $this->asRoute;
        $route = $this->route;

        return view($this->moduleDirView . '.' . $this->subDirView . '.index',
            compact('singleTitle', 'route', 'asRoute', 'moduleNamespace')
        );
    }

    public function data(Request $request)
    {
        $categories = new $this->model();

        if ($request->has('filter')) {
            $filter = $request->filter;
            $categories = $categories->where(function ($query) use ($filter) {
                $query->where('title', 'LIKE', "%$filter%");
            });
        }

        if ($request->has('sort')) {
            $sort = json_decode($request->sort, true);
            $fieldName = isset($sort['fieldName']) && strlen($sort['fieldName']) ? $sort['fieldName'] : 'id';
            $order = $sort['order'] && strlen($sort['order']) ? $sort['order'] : 'desc';
            $categories = $categories->orderBy($fieldName, $order);
        }

        $categories = $categories->paginate(ADMIN_PER_PAGE);

        $data = CategoryResource::collection($categories);
        $meta = collect($categories)->except('data');

        return response()->json(compact('data', 'meta'));
    }

    public function create()
    {
        $asRoute = $this->moduleNamespace;

        meta_data(trans_module_job('admin.categories'), trans_module_job('admin.categories'), [
            $this->routeUrl => trans_module_job('admin.categories'),
            '' => trans_module_job('admin.create') . ' ' . trans_module_job('admin.categories'),
        ]);

        return view($this->moduleDirView . '.' . $this->subDirView . '.create', compact('asRoute'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $id = $request->id;

        if ($id)
            $store = $this->model::find($id);  // edit
        else
            $store = new $this->model; // add

        $store->title = $request->title;
        $store->save();

        Cache::forget('careerCategories');
        return $this->successResponse($store);
    }

    public function edit($id)
    {
        $asRoute = $this->moduleNamespace;

        meta_data(trans_module_job('admin.categories'), trans_module_job('admin.categories'), [
            $this->routeUrl => trans_module_job('admin.categories'),
            '' => trans_module_job('admin.create') . ' ' . trans_module_job('admin.categories'),
        ]);

        $category = $this->model::find($id);

        return view($this->moduleDirView . '.' . $this->subDirView . '.create',
            compact('asRoute', 'category')
        );
    }

    public function destroy($id)
    {
        $delete = $this->model::findOrFail($id)->delete();
        Cache::forget('careerCategories');
        return $this->deleteResponse($delete);
    }

    public function all()
    {
        return $this->response(CareerCategoriesResources::collection(CareerCategories::getCategories()));
    }

}
