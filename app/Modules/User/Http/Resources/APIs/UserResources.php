<?php


namespace User\Http\Resources\APIs;


use Country\Http\Resources\CityResource;
use Country\Http\Resources\RegionResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Job\Http\Resources\App\JobSalaryRangeResource;

class UserResources extends JsonResource
{
    public function toArray($request)
    {
        $profile = isset($this->profile) ? $this->profile : null;

        return [
            'id' => $this->id,
            'image300' => $this->image300,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'about_me' => isset($profile) ? $profile->about_me : null,
            'hourly_wage' => isset($profile->salaryRange) ? new  JobSalaryRangeResource($profile->salaryRange) : null,
            'phone' => $profile->telephone,
            'region' => isset($profile->region) ? (new RegionResource($profile->region)) : '',
            'city' => isset($profile->city) ? (new CityResource($profile->city)) : '',
            'street' => $profile->street,
            'house_number' => $profile->house_number,
            'postal_code' => $profile->postal_code,
            'profession' => isset($profile->profession) ? (new ProfessionResources($profile->profession)) : '',
            'skills' => SkillResource::collection($this->skills),
            'redirect_after_login' => $this->redirect_after_login,
            'receive_notifications_email' => $this->receive_notifications_email,
            'format_display_name' => $this->format_display_name,
            'show_mobile' => $this->show_mobile,
            'show_email' => $this->show_email,
            'show_telephone' => $this->show_telephone,
            'preferred_contact_methode' => $this->preferred_contact_methode,
            'verify_account' => $this->verify_account,
            'add_special_job' => $this->add_special_job,
            'appear_on_the_retired_page' => $this->appear_on_the_retired_page,
            'as_login' => $this->as_login,
        ];
    }
}
