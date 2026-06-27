<?php


namespace Product\Http\Resources\AdminPanel\Attribute;


use Illuminate\Http\Resources\Json\JsonResource;

class AttributeValueResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            'name' => $this->name,
            'attribute_id' => $this->attribute_id,
        ];
    }
}
