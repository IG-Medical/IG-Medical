<?php

namespace Job\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class CareerCategories extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    public $translatable = ['title'];

    public static function getCategories()
    {
        return Cache::remember('careerCategories', CACHE_TTL, function () {
            return self::select('id', 'title')->get();
        });
    }
}
