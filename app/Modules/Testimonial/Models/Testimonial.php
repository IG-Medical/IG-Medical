<?php

namespace Testimonial\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
    public $guarded = [];
    public $appends = ['image_url'];
    public const DIR_UPLOADS = 'testimonials';

    public static function getTestimonials()
    {
        return Cache::remember('testimonials', CACHE_TTL, function () {
            return self::all();
        });
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image)
            return user_default();

        return assetUpload(self::DIR_UPLOADS . '/' . $this->image);
    }

}
