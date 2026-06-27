<?php

namespace Job\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CareerApplication extends Model
{
    use SoftDeletes;

    public const SALUTATIONS_MR = 1;
    public const SALUTATIONS_MRS = 2;
    public const SALUTATIONS_MS = 3;
    public const DIR_UPLOAD = 'applications';

    public static function salutations()
    {
        return [
            self::SALUTATIONS_MR => trans_module_job('app.mr'),
            self::SALUTATIONS_MRS => trans_module_job('app.mrs'),
            self::SALUTATIONS_MS => trans_module_job('app.ms'),
        ];
    }


    public static function attentiveToBusinessThrough()
    {
        return [
            16 => trans_module_job('app.approached_to_apply_ig_medical_or_agency'),
            17 => trans_module_job('app.business_network_Linkedin_glassdoor'),
            2 => trans_module_job('app.facebook'),
            3 => trans_module_job('app.fair_career_event_at_university_college'),
            4 => trans_module_job('app.google_internet_search'),
            5 => trans_module_job('app.indeed'),
            6 => trans_module_job('app.instagram'),
            7 => trans_module_job('app.job_centre'),
            8 => trans_module_job('app.monster'),
            9 => trans_module_job('app.a_n'),
            10 => trans_module_job('app.other_job_boards'),
            11 => trans_module_job('app.recommended_by_a_friend_personal_contact'),
            12 => trans_module_job('app.ig_medical_careers_website'),
            13 => trans_module_job('app.stockoverflow.com'),
            14 => trans_module_job('app.stepstone'),
            15 => trans_module_job('app.twitter'),

        ];
    }

    protected $guarded = [];

    protected $appends = [
        'humans_date',
        'full_name',
        'file_curriculum_url',
        'file_testimonials_url',
        'file_miscellaneous_url',
        'file_total_package_url',
        'file_write_to_url',
        'file_curriculum_type',
        'file_testimonials_type',
        'file_miscellaneous_type',
        'file_total_package_type',
        'file_write_to_type',
    ];

    public function getFileCurriculumUrlAttribute()
    {
        return $this->file_curriculum ? assetUpload(self::DIR_UPLOAD . '/' . $this->file_curriculum) : null;
    }

    public function getFileCurriculumTypeAttribute()
    {
        $extension = null;
        if ($this->file_curriculum_url) {
            $extension = pathinfo($this->file_curriculum_url, PATHINFO_EXTENSION);
        }
        return $extension;
    }

    public function getFileTestimonialsTypeAttribute()
    {
        $extension = null;
        if ($this->file_curriculum_url) {
            $extension = pathinfo($this->file_testimonials_url, PATHINFO_EXTENSION);
        }
        return $extension;
    }

    public function getFileTestimonialsUrlAttribute()
    {
        return $this->file_testimonials ? assetUpload(self::DIR_UPLOAD . '/' . $this->file_testimonials) : null;
    }

    public function getFileMiscellaneousTypeAttribute()
    {
        $extension = null;
        if ($this->file_curriculum_url) {
            $extension = pathinfo($this->file_miscellaneous_url, PATHINFO_EXTENSION);
        }
        return $extension;
    }

    public function getFileMiscellaneousUrlAttribute()
    {
        return $this->file_miscellaneous ? assetUpload(self::DIR_UPLOAD . '/' . $this->file_miscellaneous) : null;
    }

    public function getFileTotalPackageTypeAttribute()
    {
        $extension = null;
        if ($this->file_curriculum_url) {
            $extension = pathinfo($this->file_total_package_url, PATHINFO_EXTENSION);
        }
        return $extension;
    }

    public function getFileTotalPackageUrlAttribute()
    {
        return $this->file_total_package ? assetUpload(self::DIR_UPLOAD . '/' . $this->file_total_package) : null;
    }

    public function getFileWriteToUrlAttribute()
    {
        return $this->file_write_to ? assetUpload(self::DIR_UPLOAD . '/' . $this->file_write_to) : null;
    }

    public function getFileWriteToTypeAttribute()
    {
        $extension = null;
        if ($this->file_curriculum_url) {
            $extension = pathinfo($this->file_write_to_url, PATHINFO_EXTENSION);
        }
        return $extension;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    public function getHumansDateAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }
}
