<?php


namespace Distributor\Http\Controllers\AdminPanel;

use App\Models\Country;
use Distributor\Http\Requests\AdminPanel\Distributor\StoreDistributorRequest;
use Distributor\Http\Resources\AdminPanel\Distributor\DistributorResource;
use Distributor\Models\Distributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Testimonial\Http\Requests\AdminPanel\Testimonial\StoreTestimonialRequest;

class DistributorController extends CoreController
{
    use DistributorTrait;

    public function __construct(Distributor $distributor)
    {
        $this->subDirView = 'distributors';
        $this->asRoute = 'distributor';
        $this->route = 'distributors';
        $this->routeUrl = route_admin($this->asRoute . '.index');

        parent::__construct($distributor);
    }

    public function index()
    {
        meta_data(trans_module_distributor('admin.distributors'), trans_module_distributor('admin.distributors'), [
            '' => trans_module_distributor('admin.distributors')
        ]);

        $singleTitle = trans_module_distributor('admin.distributor');
        $moduleNamespace = $this->moduleNamespace;
        $route = $this->moduleRoute;
        $asRoute = $this->asRoute;


        return view($this->moduleDirView . '.index',
            compact('singleTitle', 'route', 'moduleNamespace', 'asRoute')
        );
    }


    public function create()
    {
        meta_data(trans_module_distributor('admin.distributors'), trans_module_distributor('admin.distributors'), [
            $this->routeUrl => trans_module_distributor('admin.distributors'),
            '' => trans_module_distributor('admin.create') . ' ' . trans_module_distributor('admin.distributor'),
        ]);

        $DIR_UPLOADS = $this->model::DIR_UPLOADS;
        $asRoute = $this->asRoute;
        $moduleNamespace = $this->moduleNamespace;
        $countries = Country::getCountries();
        return view($this->moduleDirView . '.create',
            compact('asRoute', 'DIR_UPLOADS', 'moduleNamespace','countries')
        );
    }

    public function data(Request $request)
    {
        $distributors = new $this->model();

        $distributors = $this->filter($request, $distributors);

        $distributors = $this->sort($request, $distributors);

        $distributors = $distributors->paginate(ADMIN_PER_PAGE);

        $data = DistributorResource::collection($distributors);
        $meta = collect($distributors)->except('data');

        return $this->response([
            'data' => $data,
            'meta' => $meta
        ]);
    }


    public function edit($id)
    {
        meta_data(trans_module_distributor('admin.distributors'), trans_module_distributor('admin.distributors'), [
            $this->routeUrl => trans_module_distributor('admin.distributors'),
            '' => trans_module_distributor('admin.edit') . ' ' . trans_module_distributor('admin.distributor'),
        ]);

        $distributor = $this->model::findOrFail($id);

        $DIR_UPLOADS = $this->model::DIR_UPLOADS;
        $asRoute = $this->asRoute;
        $moduleNamespace = $this->moduleNamespace;
        $countries = Country::getCountries();
        return view($this->moduleDirView . '.create',
            compact('asRoute', 'distributor', 'moduleNamespace', 'DIR_UPLOADS','countries')
        );
    }

    public function store(StoreDistributorRequest $request)
    {
        $id = $request->id;

        if ($id) {
            $store = $this->model::find($id);
        } else {
            $store = new $this->model;
        }

        $store->title = $request->title;
        $store->description = $request->description;
        $store->image = $request->image;
        $store->lat = $request->lat;
        $store->long = $request->long;
        $store->show_map = $request->show_map;
        $store->country_id = $request->country;
        $store->save();

        Cache::forget('distributors');

        return $this->successResponse($store);
    }

    public function destroy($id)
    {
        $delete = $this->model::findOrFail($id)->delete();

        Cache::forget('distributors');

        return $this->deleteResponse($delete);
    }
}
