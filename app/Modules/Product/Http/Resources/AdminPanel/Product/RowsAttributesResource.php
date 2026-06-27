<?php


namespace Product\Http\Resources\AdminPanel\Product;


use Illuminate\Http\Resources\Json\JsonResource;

class RowsAttributesResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "attribute_id" => $this->attribute_id,
            "values" => collect($this->productAttributeValues)->pluck('attribute_value_id'),
        ];
    }
}
