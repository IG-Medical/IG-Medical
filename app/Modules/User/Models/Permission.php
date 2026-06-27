<?php

namespace User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Permission extends Model
{
    use HasTranslations;

    public $translatable = ['show_name'];


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function group()
    {
        return $this->belongsTo(PermissionGroup::class, 'group_id');
    }

    public static function getAll()
    {
        return Cache::remember('permissions', CACHE_TTL, function () {
            return self::all();
        });
    }

}
