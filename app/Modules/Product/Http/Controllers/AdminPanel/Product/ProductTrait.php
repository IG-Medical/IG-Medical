<?php


namespace Product\Http\Controllers\AdminPanel\Product;


trait ProductTrait
{
    public function filter($request, $model)
    {
        // Handle trashed filtering
        if ($request->has('trashed') && $request->trashed == '1') {
            // Show only trashed items
            $model = $model->onlyTrashed();
        } else {
            // Default: include trashed items with active items
            $model = $model->withTrashed();
        }

        if ($request->filter) {
            $model = $model->where(function ($query) use ($request) {
                $text = $request->filter;
                $lang = getAppLocale();
                $query->where("name->$lang", 'LIKE', "%$text%");
            });
        }
        return $model;
    }

    public function sort($request, $model)
    {
        if ($request->has('sort')) {
            $sort = json_decode($request->sort, true);
            $fieldName = isset($sort['fieldName']) && strlen($sort['fieldName']) ? $sort['fieldName'] : 'id';
            $order = $sort['order'] && strlen($sort['order']) ? $sort['order'] : 'asc';
            $model = $model->orderBy($fieldName, $order);
        }
        return $model;
    }
}
