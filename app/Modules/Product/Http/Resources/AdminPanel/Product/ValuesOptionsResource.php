<?php


namespace Product\Http\Resources\AdminPanel\Product;


use Illuminate\Http\Resources\Json\JsonResource;

class ValuesOptionsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'label' => count($this->getTranslations('label')) > 0 ? $this->getTranslations('label') : default_array_lang(),
            'price' => $this->price,
            'option_id' => $this->option_id,
        ];
    }
}
