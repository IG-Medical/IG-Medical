<?php


namespace Job\Http\Resources\Exports;


use App\Http\Resources\CountryResource;
use Degree\Http\Resources\AdminPanel\DegreeResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Job\Http\Resources\AdminPanel\JobsLevelsResource;
use Job\Http\Resources\AdminPanel\JobsTitlesResource;
use Job\Http\Resources\CareerStatusResource;


class GenerateCareerExportResources extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => isset($this->title) ? $this->title->name : null,
            'industry' => isset($this->companyIndustry) ? $this->companyIndustry->name : '',
            'job_country' => isset($this->jobCountry) ? $this->jobCountry->name : null,
            'jobCity' => $this->city,
            'employmentType' => isset($this->employmentType) ? $this->employmentType->name : '',
            'salaryRange' => isset($this->salaryRange) ? $this->salaryRange->range : null,
            'remote_career' => $this->remote_career == YES,
            'no_of_vacancies' => $this->no_of_vacancies,
            'career_level' => isset($this->level) ? $this->level->name :null,
            'min_year_of_exp' => $this->min_year_of_exp,
            'max_year_of_exp' => $this->max_year_of_exp,
            'major' => $this->major,
            'degree' => isset($this->degree) ? $this->degree->name : null,
            'residence_country_applicant' => isset($this->personResidenceCountry) ? $this->personResidenceCountry->name : null,
            'residence_city_applicant' => isset($this->residence_city) ? $this->residence_city : null,
            'nationality_country_applicant' => isset($this->personNationality) ? $this->personNationality->name : null,
            'gender' => $this->gender ? genders()[$this->gender] : null,
            'max_age' => $this->max_age,
            'min_age' => $this->min_age,
            'user_id' =>isset($this->user) ? $this->user->id : null,
            'user_full_name' => isset($this->user) ? $this->user->full_name : null,
            'user_email' => isset($this->user) ? $this->user->email : null,
            'user_mobile' =>isset($this->user) ?  $this->user->mobile: null,
            'created_at' => $this->created_at,
            'date_publication' => $this->date_publication,
            'number_of_applicants' => $this->number_of_applicants,
            'status' => $this->status->name,
        ];
    }

}