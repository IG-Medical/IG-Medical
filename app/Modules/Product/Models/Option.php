<?php

namespace Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Option extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $guarded = [];
    public $translatable = ['name'];

    public $appends = ['show_type'];

    public const TYPE_CHECKBOX = 1;
    public const TYPE_RADIO = 2;

    public function getShowTypeAttribute($data)
    {
        $type = null;

        if (self::TYPE_CHECKBOX)
            $type = 'checkbox';

        if (self::TYPE_RADIO)
            $type = 'radio';

        return $type;
    }

    public function values()
    {
        return $this->hasMany(OptionValue::class, 'option_id');
    }
}
