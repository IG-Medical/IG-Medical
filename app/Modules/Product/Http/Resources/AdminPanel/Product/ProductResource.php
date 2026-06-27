<?php


namespace Product\Http\Resources\AdminPanel\Product;


use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            "id" => $this->id,
            "youtube" => $this->youtube,
            "name" => $this->getTranslations('name'),
            "short_description" => $this->getTranslations('short_description'),
            "basic_configuration" => $this->getTranslations('basic_configuration'),
            "description" => $this->getTranslations('description'),
            "price" => $this->price,
            "discount_percentage" => $this->discount_percentage,
            "icon" => $this->icon,
            "pdf" => $this->pdf,
            "main_image" => $this->main_image,
            "main_image_url" => $this->main_image_url,
            "pdf_url" => $this->pdf_url,
            "icon_url" => $this->icon_url,
            "gallery" => $this->gallery,
            "qty" => $this->qty,
            "is_active" => $this->is_active,
            "category_id" => $this->category_id,
            "attributes" => $this->attributes,
            "rows_attributes" => RowsAttributesResource::collection($this->attributes),
            "rows_options" => RowsOptionsResource::collection($this->options),
        ];
    }
}
