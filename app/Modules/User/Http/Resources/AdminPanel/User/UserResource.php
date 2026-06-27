<?php


namespace User\Http\Resources\AdminPanel\User;


use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\UserStatusResource;
use User\Http\Resources\UserTypeResource;

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
            'status' => new UserStatusResource($this->status),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'add_special_job' => $this->add_special_job,
        ];
    }
}
