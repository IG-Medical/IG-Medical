<?php


namespace Setting\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'image' => $this->image300,
            'email' => $this->email,
            'mobile' => $this->mobile,
        ];
    }
}
