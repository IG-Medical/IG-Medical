<?php


namespace Product\Http\Resources\AdminPanel\Product;


use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "shor_description" => $this->shor_description,
            "main_image_url" => $this->main_image_url,
            "price" => $this->price,
            "price_after_discount" => $this->price_after_discount,
            "discount_percentage" => $this->discount_percentage,
            "qty" => $this->qty,
            "is_new" => $this->is_new,
            "status_id" => $this->status_id,
            "status" => $this->status,
            "is_active" => $this->is_active,
            "created_at" => $this->created_at,
            "deleted_at" => $this->deleted_at,
        ];
    }
}
