<?php


namespace Product\Http\Resources\AdminPanel\Option;


use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            'name' => $this->name,
            'show_type' => $this->show_type,
            'created_at' => $this->created_at,
        ];
    }
}
