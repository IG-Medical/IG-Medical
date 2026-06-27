<?php

namespace News\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class News extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'content', 'image','short_content'];
    public const DIR_UPLOADS = 'news';
    protected $guarded = [];

    public $appends = ['image_url', 'show_image_url'];


    public function getImageUrlAttribute($data)
    {
        $images_array = [];
        $image_origin = $this->getOriginal('image');

        foreach (languages() as $key => $value) {
            if (isset($image_origin[$key]))
                $images_array[$key] = $image_origin[$key] ? assetUpload(self::DIR_UPLOADS . '/' . $image_origin[$key]) : null;
        }

        return $images_array;
    }

    public function getShowImageUrlAttribute()
    {
        return isset($this->image_url[getAppLocale()]) ? $this->image_url[getAppLocale()] : null;
    }

}
