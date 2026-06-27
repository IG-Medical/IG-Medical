<?php


namespace Setting\Http\Resources\AdminPanel;


use Illuminate\Http\Resources\Json\JsonResource;

class BestFreelancersResources extends JsonResource
{
    public function toArray($request)
    {
        $user = isset($this->user) ? $this->user : null;
        return [
            'id' => isset($user) ? $user->id : null,
            'full_name' => isset($user) ? $user->full_name : null,
            'image' => isset($user) ? $user->image300 : null,
            'email' => isset($user) ? $user->email : null,
            'mobile' => isset($user) ? $user->mobile : null,
            'job_title' => isset($user) ? $user->profile->job_title : null,
            'about_me' => isset($user) ? $user->profile->about_me : null,
            'range_salary' => isset($user) ? $user->profile->salaryRange->range : null

        ];
    }
}
