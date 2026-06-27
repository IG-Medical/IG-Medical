<?php


namespace Product\Http\Controllers\AdminPanel\AttributeValue;


use Illuminate\Http\Request;
use Product\Http\Controllers\AdminPanel\CoreController;
use Product\Http\Resources\AdminPanel\Attribute\AttributeValueResource;
use Product\Models\AttributeValue;

class AttributeValueController extends CoreController
{
    public function __construct(AttributeValue $model)
    {
        parent::__construct($model);
    }

    public function search(Request $request)
    {
        $query = $request->filter;

        $attribute_id = $request->attribute_id;

        $data = $this->model::where('attribute_id', $attribute_id);

        if (!is_null($query) && !is_null($attribute_id))
            $data = $data->where('name', 'LIKE', "%$query%");

        $data = AttributeValueResource::collection($data->get());

        return $this->response($data);
    }
}
