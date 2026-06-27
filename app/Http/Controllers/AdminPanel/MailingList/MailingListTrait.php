<?php


namespace App\Http\Controllers\AdminPanel\MailingList;


trait MailingListTrait
{
    public function filter($request, $model)
    {
        if ($request->filter) {
            $model = $model->where(function ($query) use ($request) {
                $text = $request->filter;
                $query->where('email', 'LIKE', "%$text%");
                $query->where('full_name', 'LIKE', "%$text%");
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
