<?php

namespace User\Models;

use Country\Models\City;
use Country\Models\Country;
use Country\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Job\Models\SalaryRange;
use Skill\Models\Profession;

class UserProfile extends Model
{

    protected $table = 'user_profile';
    public $guarded = [];

    // Relation

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function salaryRange()
    {
        return $this->belongsTo(SalaryRange::class, 'range_salary_id');

    }
}
