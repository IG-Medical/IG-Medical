<?php


namespace Job\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class CareerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'job_title' => $this->job_title,
        ];
    }
}
