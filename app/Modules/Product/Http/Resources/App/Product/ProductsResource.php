<?php


namespace Product\Http\Resources\App\Product;


use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->getTranslations('name'),
            "slug" => $this->slug,
            "short_description" => $this->short_description,
            "show_price" => $this->show_price,
            "price" => $this->price,
            "discount_percentage" => $this->discount_percentage,
            "price_after_discount" => $this->price_after_discount,
            "show_price_after_discount" => $this->show_price_after_discount,
            "main_image_url" => $this->main_image_url,
            "qty" => $this->qty,
            "status" => $this->status,
            "is_favorite" => is_favorite($this->id),
        ];
    }
}
