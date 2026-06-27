<?php


namespace Slider\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Slider\Http\Requests\AdminPanel\Slider\StoreSliderRequest;
use Slider\Http\Resources\AdminPanel\Slider\SliderResource;
use Slider\Models\Slider;

class SliderController extends CoreController
{
    use SliderTrait;

    public function __construct(Slider $slider)
    {
        $this->subDirView = 'sliders';
        $this->asRoute = 'slider';
        $this->route = 'sliders';
        $this->routeUrl = route_admin($this->asRoute . '.index');

        parent::__construct($slider);
    }

    public function index()
    {
        meta_data(trans_module_slider('admin.sliders'), trans_module_slider('admin.sliders'), [
            '' => trans_module_slider('admin.sliders')
        ]);

        $singleTitle = trans_module_slider('admin.slider');
        $moduleNamespace = $this->moduleNamespace;
        $route = $this->moduleRoute;
        $asRoute = $this->asRoute;

        return view($this->moduleDirView . '.index',
            compact('singleTitle', 'route', 'asRoute', 'moduleNamespace')
        );
    }


    public function create()
    {
        meta_data(trans_module_slider('admin.sliders'), trans_module_slider('admin.sliders'), [
            $this->routeUrl => trans_module_slider('admin.sliders'),
            '' => trans_module_slider('admin.create') . ' ' . trans_module_slider('admin.sliders'),
        ]);


        $DIR_SLIDER_UPLOADS = $this->model::DIR_SLIDER_UPLOADS;
        $asRoute = $this->asRoute;
        $moduleNamespace = $this->moduleNamespace;

        return view($this->moduleDirView . '.create',
            compact('asRoute', 'DIR_SLIDER_UPLOADS', 'moduleNamespace')
        );
    }

    public function data(Request $request)
    {
        $sliders = new $this->model();

        $sliders = $this->filter($request, $sliders);

        $sliders = $this->sort($request, $sliders);

        $sliders = $sliders->paginate(ADMIN_PER_PAGE);

        $data = SliderResource::collection($sliders);
        $meta = collect($sliders)->except('data');

        return $this->response([
            'data' => $data,
            'meta' => $meta
        ]);
    }

    public function edit($id)
    {
        $slider = $this->model::findOrFail($id);
        $slider->setAttribute('type', $slider->getAttribute('type') ?? 'web');

        meta_data(trans_module_slider('admin.sliders'), trans_module_slider('admin.sliders'), [
            $this->routeUrl => trans_module_slider('admin.sliders'),
            '' => trans_module_slider('admin.edit') . ' ' . trans_module_slider('admin.slider'),
        ]);


        $asRoute = $this->asRoute;
        $moduleNamespace = $this->moduleNamespace;
        $DIR_SLIDER_UPLOADS = $this->model::DIR_SLIDER_UPLOADS;

        return view($this->moduleDirView . '.create',
            compact('asRoute', 'slider', 'DIR_SLIDER_UPLOADS', 'moduleNamespace')
        );
    }

    public function store(StoreSliderRequest $request)
    {
        $id = $request->id;

        if ($id)
            $store = $this->model::find($id);
        else
            $store = new $this->model;

        $store->caption_1 = $request->caption_1;
        $store->caption_2 = $request->caption_2;
        $store->call_to_action_text_1 = $request->call_to_action_text_1;
        $store->call_to_action_text_2 = $request->call_to_action_text_2;
        $store->call_to_action_url_1 = $request->call_to_action_url_1;
        $store->call_to_action_url_2 = $request->call_to_action_url_2;
        $store->call_to_action_url_3 = $request->call_to_action_url_3;
        $store->background = $request->background_image;
        $store->home_page_center = $request->home_page_center;
        $store->home_page_top = $request->home_page_top;
        // $store->type = $request->type;
        $store->save();
        Cache::forget('sliders');

        return $this->successResponse($store);
    }

    public function destroy($id)
    {
        $delete = $this->model::findOrFail($id)->delete();

        Cache::forget('sliders');

        return $this->deleteResponse($delete);
    }
}
