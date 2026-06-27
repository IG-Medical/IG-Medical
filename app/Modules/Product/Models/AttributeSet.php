<?php

namespace Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class AttributeSet extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    public $translatable = ['name'];

    public static function getAttributeSets()
    {
        return Cache::remember('attributeSets', CACHE_TTL, function () {
            return self::all();
        });
    }

    public static function getAttributeSetsWithAttribute()
    {
        return Cache::remember('attributeSets', CACHE_TTL, function () {
            return self::with('attributes')->get();
        });
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'attribute_set_id');
    }
}
