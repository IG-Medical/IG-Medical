<?php


namespace Job\Http\Resources\AdminPanel;


use Illuminate\Http\Resources\Json\JsonResource;
use Job\Models\CareerApplication;

class CareerApplicationsResource extends JsonResource
{
    public function toArray($request)
    {
        $salutations = CareerApplication::salutations();
        $attentive_to_business_through = CareerApplication::attentiveToBusinessThrough();

        return [
            'id' => $this->id,
            'career' => isset($this->career) ? $this->career->job_title : null,
            'salutation' => array_key_exists($this->salutation, $salutations) ? $salutations[$this->salutation] : null,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'street' => $this->street,
            'number' => $this->number,
            'plz' => $this->plz,
            'place_of_residence' => $this->place_of_residence,
            'land' => $this->land,
            'salary_expectations' => $this->salary_expectations,
            'earliest_start_of_work' => $this->earliest_start_of_work,
            'attentive_to_business_through' =>array_key_exists($this->attentive_to_business_through, $attentive_to_business_through) ? $attentive_to_business_through[$this->attentive_to_business_through] : null,
            'internal_application' => $this->internal_application,
            'data_protection' => $this->data_protection,
            'admission_to_talent_pool' => $this->admission_to_talent_pool,
            'file_curriculum' => $this->file_curriculum_url,
            'file_testimonials' => $this->file_testimonials_url,
            'file_miscellaneous' => $this->file_miscellaneous_url,
            'file_total_package' => $this->file_total_package_url,
            'file_write_to' => $this->file_write_to_url,
            'file_curriculum_type' => $this->file_curriculum_type,
            'file_testimonials_type' => $this->file_testimonials_type,
            'file_miscellaneous_type' => $this->file_miscellaneous_type,
            'file_total_package_type' => $this->file_total_package_type,
            'file_write_to_type' => $this->file_write_to_type,
        ];
    }
}
