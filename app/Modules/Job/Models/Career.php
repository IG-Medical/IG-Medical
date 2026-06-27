<?php

namespace Job\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Career extends Model
{
    use HasTranslations, SoftDeletes;

    public $translatable = ['job_title', 'description', 'location', 'experience', 'status'];

    protected $guarded = [];
    protected $appends = [
        'slug',
        'humans_date_publication',
        'strip_tags_description',
        'show_deadline',
        'published_on',
    ];

    public function getShowDeadlineAttribute()
    {
        return Carbon::parse($this->deadline)->format(config('app.career_deadline_format'));
    }

    public function getPublishedOnAttribute()
    {
        return Carbon::parse($this->created_at)->format(config('app.career_deadline_format'));
    }

    public function category()
    {
        return $this->belongsTo(CareerCategories::class, 'category_id');
    }


    public function applications()
    {
        return $this->hasMany(CareerApplication::class, 'career_id');
    }

    public function getSlugAttribute($value)
    {
        return Str::slug($this->job_title) . '-' . $this->uniq_id;
    }

    public function getStripTagsDescriptionAttribute($value)
    {
        return isset($this->description) ? strip_tags($this->description) : null;
    }

    public function getHumansDatePublicationAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint)
    {
        return $query->whereHas($relation, $constraint)->with([$relation => $constraint]);
    }

}
