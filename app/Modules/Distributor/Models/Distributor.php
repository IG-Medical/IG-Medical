<?php

namespace Distributor\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Distributor extends Model
{
    use HasTranslations;

    public $translatable = ['title','description'];
    public $guarded = [];
    public $appends = ['image_url'];
    public const DIR_UPLOADS = 'distributors';


    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public static function getDistributors()
    {
        return Cache::remember('distributors', CACHE_TTL, function () {
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
