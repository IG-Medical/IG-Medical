<?php


namespace Product\Http\Resources\AdminPanel\Product;


use Illuminate\Http\Resources\Json\JsonResource;

class OptionResources extends JsonResource
{
    public function toArray($request)
    {
        return [
            "name" => $this->getTranslations('name'),
            "type" => $this->type,
            "values" => ValuesOptionsResource::collection($this->values),
        ];
    }
}
