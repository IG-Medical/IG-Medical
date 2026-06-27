<?php


namespace Testimonial\Http\Resources\AdminPanel\Testimonial;


use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "full_name" => $this->full_name,
            "testimonial_text" => $this->testimonial_text,
            "job_title" => $this->job_title,
            "image_url" => $this->image_url,
            "updated_at" => $this->updated_at,
        ];
    }
}
