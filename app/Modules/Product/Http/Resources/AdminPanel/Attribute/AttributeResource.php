<?php


namespace Product\Http\Resources\AdminPanel\Attribute;


use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            'name' => $this->name,
            'attribute_set_name' => isset($this->attributeSet) ? $this->attributeSet->name : null,
            'values' => AttributeValueResource::collection($this->values),
            'created_at' => $this->created_at,
        ];
    }
}
