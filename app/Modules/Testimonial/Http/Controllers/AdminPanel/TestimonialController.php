<?php


namespace Testimonial\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Testimonial\Http\Requests\AdminPanel\Testimonial\StoreTestimonialRequest;
use Testimonial\Http\Resources\AdminPanel\Testimonial\TestimonialResource;
use Testimonial\Models\Testimonial;

class TestimonialController extends CoreController
{
    use TestimonialTrait;

    public function __construct(Testimonial $testimonial)
    {
        $this->subDirView = 'testimonials';
        $this->asRoute = 'testimonial';
        $this->route = 'testimonials';
        $this->routeUrl = route_admin($this->asRoute . '.index');

        parent::__construct($testimonial);
    }

    public function index()
    {
        meta_data(trans_module_testimonial('admin.testimonials'), trans_module_testimonial('admin.testimonials'), [
            '' => trans_module_testimonial('admin.testimonials')
        ]);

        $singleTitle = trans_module_testimonial('admin.testimonial');
        $moduleNamespace = $this->moduleNamespace;
        $route = $this->moduleRoute;
        $asRoute = $this->asRoute;


        return view($this->moduleDirView . '.index',
            compact('singleTitle', 'route', 'moduleNamespace', 'asRoute')
        );
    }


    public function create()
    {
        meta_data(trans_module_testimonial('admin.testimonials'), trans_module_testimonial('admin.testimonials'), [
            $this->routeUrl => trans_module_testimonial('admin.testimonials'),
            '' => trans_module_testimonial('admin.create') . ' ' . trans_module_testimonial('admin.testimonial'),
        ]);

        $DIR_UPLOADS = $this->model::DIR_UPLOADS;
        $asRoute = $this->asRoute;
        $moduleNamespace = $this->moduleNamespace;

        return view($this->moduleDirView . '.create',
            compact('asRoute', 'DIR_UPLOADS', 'moduleNamespace')
        );
    }

    public function data(Request $request)
    {
        $testimonials = new $this->model();

        $testimonials = $this->filter($request, $testimonials);

        $testimonials = $this->sort($request, $testimonials);

        $testimonials = $testimonials->paginate(ADMIN_PER_PAGE);

        $data = TestimonialResource::collection($testimonials);
        $meta = collect($testimonials)->except('data');

        return $this->response([
            'data' => $data,
            'meta' => $meta
        ]);
    }


    public function edit($id)
    {
        meta_data(trans_module_testimonial('admin.testimonials'), trans_module_testimonial('admin.testimonials'), [
            $this->routeUrl => trans_module_testimonial('admin.testimonials'),
            '' => trans_module_testimonial('admin.edit') . ' ' . trans_module_testimonial('admin.testimonial'),
        ]);

        $testimonial = $this->model::findOrFail($id);

        $DIR_UPLOADS = $this->model::DIR_UPLOADS;
        $asRoute = $this->asRoute;
        $moduleNamespace = $this->moduleNamespace;

        return view($this->moduleDirView . '.create',
            compact('asRoute', 'testimonial', 'moduleNamespace', 'DIR_UPLOADS')
        );
    }

    public function store(StoreTestimonialRequest $request)
    {
        $id = $request->id;

        if ($id) {
            $store = $this->model::find($id);
        } else {
            $store = new $this->model;
        }
        $store->full_name = $request->full_name;
        $store->job_title = $request->job_title;
        $store->image = $request->image;
        $store->testimonial_text = $request->testimonial_text;
        $store->save();

        Cache::forget('testimonials');

        return $this->successResponse($store);
    }

    public function destroy($id)
    {
        $delete = $this->model::findOrFail($id)->delete();

        Cache::forget('testimonials');

        return $this->deleteResponse($delete);
    }
}
