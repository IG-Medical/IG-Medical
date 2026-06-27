<?php


namespace Slider\Http\Controllers\AdminPanel;


trait SliderTrait
{
    public function filter($request, $model)
    {
        if ($request->filter) {
            $model = $model->where(function ($query) use ($request) {
                $text = $request->filter;
                $query->where('caption_1', 'LIKE', "%$text%");
                $query->orwhere('caption_2', 'LIKE', "%$text%");
                $query->orwhere('caption_3', 'LIKE', "%$text%");
            });
        }
        return $model;
    }

    public function sort($request, $model)
    {
        if ($request->has('sort')) {
            $sort = json_decode($request->sort, true);
            $fieldName = isset($sort['fieldName']) && strlen($sort['fieldName']) ? $sort['fieldName'] : 'id';
            $order = $sort['order'] && strlen($sort['order']) ? $sort['order'] : 'desc';
            $model = $model->orderBy($fieldName, $order);
        }
        return $model;
    }
}
