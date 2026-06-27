<?php


namespace Product\Http\Controllers\App\Search;


use Category\Models\Category;

trait ProductFilter
{
    public function filter($request, $model)
    {
        $model = $model->active();
        $filter = json_decode($request->filter);

        if ($filter->text) {
            $model = $model->where(function ($query) use ($filter) {
                $text = $filter->text;
                $lang = getAppLocale();
                $query->where("name->$lang", 'LIKE', "%$text%")->orwhere("short_description->$lang", 'LIKE', "%$text%");
            });
        }

        if (isset($filter->category_id)) {
            $cate_id = (int)$filter->category_id;

            if ($cate_id === 0) {
                $categories = Category::with('children')->where('slug', $filter->category_id)->first();
                $categories_ids [] = $categories->id;
                $category_2 = isset($categories->children) ? $categories->children : [];

                if (count($category_2) > 0) {
                    foreach ($category_2 as $key => $value) {
                        $categories_ids [] = $value->id;
                        $category_3 = isset($value->children) ? $value->children : [];

                        if (count($category_3) > 0) {
                            foreach ($category_3 as $k => $v)
                                $categories_ids [] = $v->id;
                        }
                    }
                }
                $model = $model->whereIn('category_id', $categories_ids);

            } else {
                $categories = Category::with('children')->find($filter->category_id);
                $categories_ids [] = $categories->id;

                $category_2 = isset($categories->children) ? $categories->children : [];

                if (count($category_2) > 0) {
                    foreach ($category_2 as $key => $value) {
                        $categories_ids [] = $value->id;
                        $category_3 = isset($value->children) ? $value->children : [];

                        if (count($category_3) > 0) {
                            foreach ($category_3 as $k => $v)
                                $categories_ids [] = $v->id;
                        }
                    }
                }
                $model = $model->whereIn('category_id', $categories_ids);
            }
        }

        if (isset($filter->price->min) && !empty($filter->price->min))
            $min = $filter->price->min;
        else
            $min = 0;

        if (isset($filter->price->max) && !empty($filter->price->max))
            $max = $filter->price->max;
        else
            $max = 1000000;

        $model = $model->whereBetween('price', [$min, $max]);


        if (count($filter->view_only) > 0) {
            if (in_array('discount', $filter->view_only)) {
                $model = $model->whereNotNull('discount_percentage');
            }
            if (in_array('in_stock', $filter->view_only)) {
                $model = $model->whereNotNull('qty')->orWhere('qty', '>', 0);
            }
            if (in_array('new_arrivals', $filter->view_only)) {

            }
        }
        return $model;
    }

    public function sort($request, $model)
    {
        $filter = json_decode($request->filter);

        if ($request->has('sort')) {

            $sort = $request->sort;

            $orderBy = $request->order_by;

            $fieldName = isset($sort) && strlen($sort) ? $sort : 'id';
            $order = $orderBy && strlen($orderBy) ? $orderBy : 'desc';

            if ($sort === 'latest') {
                $fieldName = 'created_at';
                $order = 'desc';
            }

            if ($sort === 'cheapest') {
                $fieldName = 'price_discount';
                $order = 'asc';
            }

            if (in_array('most_sales', $filter->view_only) || $sort === 'most_sales') {
                $fieldName = 'number_of_sales';
                $order = 'desc';
            }

            $model = $model->orderBy($fieldName, $order);
        }
        return $model;
    }

}
