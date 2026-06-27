<?php


namespace User\Http\Resources\App;


use Country\Http\Resources\CityResource;
use Country\Http\Resources\RegionResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Skill\Http\Resources\SkillResource;
use Skill\Http\Resources\ProfessionResources;

class UserResources extends JsonResource
{
    public function toArray($request)
    {
        $profile = isset($this->profile) ? $this->profile : null;

        return [
            'id' => $this->id,
            'image300' => $this->image300,
            'image' => $this->image,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'about_me' => isset($profile) ? $profile->about_me : null,
            'phone' => $profile->telephone,
            'region' => new RegionResource($profile->region),
            'city' => new CityResource($profile->city),
            'street' => $profile->street,
            'house_number' => $profile->house_number,
            'postal_code' => $profile->postal_code,
            'range_salary_id' => $profile->range_salary_id,
            'profession' => new ProfessionResources($profile->profession),
            'skills' => SkillResource::collection($this->skills),
        ];
    }
}
