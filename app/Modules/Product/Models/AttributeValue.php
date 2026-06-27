<?php

namespace Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class AttributeValue extends Model
{
    use HasFactory, HasTranslations;

    public $guarded = [];
    public $translatable = ['name'];

    public static function store($data, $id)
    {
        if (count($data) > 0) {
            self::where('attribute_id', $id)->delete();
            Cache::forget('attributeValues');
            foreach ($data as $key => $value) {
                $array = [
                    'attribute_id' => $id,
                    'name' => $value['name'],
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ];
                self::create($array);
            }
        }
    }

    public static function getAttributeValues()
    {
        return Cache::remember('attributeValues', CACHE_TTL, function () {
            return self::all();
        });
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
