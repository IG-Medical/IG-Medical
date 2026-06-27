<?php


namespace Job\Http\Resources\AdminPanel;

use Illuminate\Http\Resources\Json\JsonResource;
use Job\Http\Resources\UserResource;

class CareerResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'job_title' => $this->job_title,
            'location' => $this->location,
        ];
    }
}
