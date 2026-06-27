<?php


namespace Product\Http\Resources\App\Product;


use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResources extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'discount_percentage' => $this->discount_percentage,
            'show_price' => $this->show_price,
            'qty' => $this->qty,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'attributes' => ProductDetailsAttributesResources::collection($this->attributes),
        ];
    }
}
