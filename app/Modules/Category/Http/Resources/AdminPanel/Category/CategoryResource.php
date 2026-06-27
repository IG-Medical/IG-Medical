<?php


namespace Category\Http\Resources\AdminPanel\Category;


use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "text" => $this->name,
            "image_url" => $this->image_url,
            "icon_url" => $this->icon_url,
            "icon" => $this->icon,
            "image" => $this->image,
            "is_searchable" => $this->is_searchable,
            "is_active" => $this->is_active,
            "parent_id" => $this->parent_id,
        ];
    }
}
