<?php

namespace Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Product\Http\Resources\AdminPanel\Attribute\AttributeResource;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    public $translatable = ['name'];

    public static function getAttributesAll()
    {
        return Cache::remember('attributes', CACHE_TTL, function () {
            return AttributeResource::collection(self::with('attributeSet','values')->get());
        });
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id');
    }

    public function attributeSet()
    {
        return $this->belongsTo(AttributeSet::class, 'attribute_set_id');
    }
}
