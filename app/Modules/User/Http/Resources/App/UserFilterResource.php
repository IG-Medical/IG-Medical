<?php


namespace User\Http\Resources\App;


use Illuminate\Http\Resources\Json\JsonResource;
use Skill\Http\Resources\SkillResource;

class UserFilterResource extends JsonResource
{
    public function toArray($request)
    {
        $profile = $this->profile;

        return [
            'slug' => $this->slug,
            'uniq_id' => $this->uniq_id,
            'id' => $this->id,
            'show_full_name' => $this->show_full_name,
            'image300' => $this->image300,
            'salary_range' => isset($profile->salaryRange) ? $profile->salaryRange->range2 : null,
            'region' => isset($profile->region) ? $profile->region->name : null,
            'profession' => isset($profile->profession) ? $profile->profession->name : null,
            'about_me' => isset($profile->about_me) ? $profile->about_me : '',
            'skills' => SkillResource::collection($this->skills),
        ];
    }
}
