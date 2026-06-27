<?php

namespace User\Http\Resources\Exports;

use Illuminate\Http\Resources\Json\JsonResource;

class GenerateUserExportResources extends JsonResource
{
    public function toArray($request)
    {
        $mobile = explode('+',$this->mobile);
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'mobile' => isset($mobile[1]) ? $mobile[1] : '',
            'email' => $this->email,
            'job_title' => isset($this->profile->job_title) ? $this->profile->job_title : null,
            'hourly_price' => isset($this->profile->hourly_rate) ? $this->profile->hourly_rate : null,
            'about_me' => isset($this->profile->about_me) ? $this->profile->about_me : null,
            'country' => isset($this->profile->country) ? $this->profile->country->name : null,
            'city' => isset($this->profile->city) ? $this->profile->city : null,
            'address1' => isset($this->profile->address1) ? $this->profile->address1 : null,
            'address2' => isset($this->profile->address2) ? $this->profile->address2 : null,
            'date_birth' => isset($this->profile->date_birth) ? $this->profile->date_birth : null,
            'gender' => isset($this->profile->gender) ? genders()[$this->profile->gender] : null,
        ];
    }
}
