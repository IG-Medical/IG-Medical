<?php


namespace Category\Http\Resources\AdminPanel\Category;


use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "text" => $this->text,
            "short_description" => $this->short_description,
            "parent_id" => $this->parent_id,
            "image_url" => $this->image_url,
            "icon_url" => $this->icon_url,
            "opened" => $this->opened,
            "selected" => $this->selected,
            "disabled" => $this->disabled,
            "children" => $this->children
        ];
    }
}
