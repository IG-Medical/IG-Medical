<?php

namespace Slider\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasFactory, HasTranslations;

    public const DIR_SLIDER_UPLOADS = 'sliders';
    protected $guarded = [];

    public const TYPE_BOTTOM = 'bottom';
    public const TYPE_TOP = 'top';

    /** Platform type (like Testimonial): web | mobile */
    public const TYPE_WEB = 'web';
    public const TYPE_MOBILE = 'mobile';

    public $translatable = [
        'caption_1',
        'caption_2',
        'caption_3',
        'call_to_action_text_1',
        'call_to_action_text_2',
        'background'
    ];

    public $appends = ['background_url', 'show_background_url'];

    public function getBackgroundUrlAttribute($data)
    {
        $images_array = [];
        $image_origin = $this->getOriginal('background');

        foreach (languages() as $key => $value) {
            if (isset($image_origin[$key]))
                $images_array[$key] = $image_origin[$key] ? assetUpload(self::DIR_SLIDER_UPLOADS . '/' . $image_origin[$key]) : null;
        }

        return $images_array;
    }

    public function getShowBackgroundUrlAttribute()
    {
        return isset($this->background_url[getAppLocale()]) ? $this->background_url[getAppLocale()] : null;
    }

    public static function getSliders()
    {
        return Cache::remember('sliders', CACHE_TTL, function () {
            return self::orderBy('created_at','desc')->get();
        });
    }

}
