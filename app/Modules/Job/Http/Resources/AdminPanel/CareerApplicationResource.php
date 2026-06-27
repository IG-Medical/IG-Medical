<?php


namespace Job\Http\Resources\AdminPanel;


use Illuminate\Http\Resources\Json\JsonResource;

class CareerApplicationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'salutation' => $this->salutation,
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
            'attentive_to_business_through' => $this->attentive_to_business_through,
            'internal_application' => $this->internal_application,
            'data_protection' => $this->data_protection,
            'admission_to_talent_pool' => $this->admission_to_talent_pool,
            'file_curriculum' => $this->file_curriculum_url,
            'file_testimonials' => $this->file_testimonials_url,
            'file_miscellaneous' => $this->file_miscellaneous_url,
            'file_total_package' => $this->file_total_package_url,
            'file_write_to' => $this->file_write_to_url,
        ];
    }
}
