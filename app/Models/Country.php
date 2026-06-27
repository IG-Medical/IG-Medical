<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded = [];

    public static function getCountries()
    {
        $countries = Cache::remember('countries', CACHE_TTL, function () {
            return self::get();
        });
        return $countries;
    }
}
