<?php


namespace User\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class UserStatusResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
