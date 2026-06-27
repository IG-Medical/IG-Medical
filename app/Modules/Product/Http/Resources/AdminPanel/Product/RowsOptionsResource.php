<?php


namespace Product\Http\Resources\AdminPanel\Product;


use Illuminate\Http\Resources\Json\JsonResource;

class RowsOptionsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            "name" =>  count($this->getTranslations('name')) > 0 ? $this->getTranslations('name') : default_array_lang(),
            "type" => $this->type,
            "values" => ValuesOptionsResource::collection($this->values),
        ];
    }
}
