<?php


namespace Job\Http\Controllers\AdminPanel;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Job\Http\Resources\AdminPanel\CareerApplicationResource;
use Job\Http\Resources\AdminPanel\CareerApplicationsResource;
use Job\Models\CareerApplication;

class CareerApplicationController extends CoreController
{
    public function __construct(CareerApplication $category)
    {
        parent::__construct($category);
    }

    public function data(Request $request)
    {

        $careers = new CareerApplication();
        $filter = json_decode($request->filter);

        if ($request->has('id')) {
            $careers = $careers->where('id', (int)$request->id);
        }



        $careers = $careers->where('career_id', $filter->careerId);

        if ($request->has('sort')) {
            $sort = json_decode($request->sort, true);
            $fieldName = isset($sort['fieldName']) && strlen($sort['fieldName']) ? $sort['fieldName'] : 'id';
            $order = $sort['order'] && strlen($sort['order']) ? $sort['order'] : 'desc';
            $careers = $careers->orderBy($fieldName, $order);
        }

        $careers = $careers->paginate(ADMIN_PER_PAGE);

        $data = CareerApplicationResource::collection($careers);
        $meta = collect($careers)->except('data');

        return response()->json(compact('data', 'meta'));
    }

    public function details($id)
    {

        $app =  new CareerApplicationsResource(CareerApplication::with('career')->findOrFail($id));
        return $this->response($app);
    }
}
