<?php

namespace Job\Http\Resources\App;

use Illuminate\Http\Resources\Json\JsonResource;
use Skill\Http\Resources\SkillResource;

class CareerResources extends JsonResource
{
    public function toArray($request)
    {


        return [
            'id' => $this->id,
            'job_title' => $this->job_title,
            'humans_date_publication' => $this->humans_date_publication,
            'slug' => $this->uniq_id,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }


}
