<?php


namespace User\Http\Resources\APIs;


use Illuminate\Http\Resources\Json\JsonResource;

class ProfessionResources extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
