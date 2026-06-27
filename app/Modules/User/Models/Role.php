<?php

namespace User\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;

class Role extends Model
{
    const ADMINISTRATION = 1;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function getAllWithPermissions()
    {
        return Cache::remember('rolesWithPermissions', CACHE_TTL, function () {
            return self::with('permissions')->get();
        });
    }

    public static function getAll()
    {
        return Cache::remember('roles', CACHE_TTL, function () {
            return self::select('id','name')->get();
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'role_has_permissions','role_id','permission_id');
    }
}
