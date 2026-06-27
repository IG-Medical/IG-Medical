<?php


namespace Product\Http\Resources\App\Product;


use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsAttributesResources extends JsonResource
{
    public function toArray($request)
    {
        return [
            'attribute' => $this->attribute,
        ];
    }
}
