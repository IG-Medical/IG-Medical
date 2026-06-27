<?php


namespace Job\Http\Resources\AdminPanel;


use Illuminate\Http\Resources\Json\JsonResource;

class CareerCategoriesResources extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
        ];
    }
}
