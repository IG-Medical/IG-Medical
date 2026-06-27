<?php


namespace Product\Http\Resources\AdminPanel\AttributeSet;


use Illuminate\Http\Resources\Json\JsonResource;
use Product\Http\Resources\AdminPanel\Attribute\AttributeResource;

class AttributeSetsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            'name' => $this->name,
          //  'attributes' => AttributeResource::collection($this->attributes)
        ];
    }
}
