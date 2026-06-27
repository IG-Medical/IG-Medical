<?php


namespace User\Http\Resources\AdminPanel\Admin;

use Illuminate\Http\Resources\Json\JsonResource;


class AdminResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'image300' => $this->image300,
            'last_login' => $this->last_login,
            'created_at' => $this->created_at,
        ];
    }
}
