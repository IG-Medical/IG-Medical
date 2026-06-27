<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class NavbarItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get the children of this navbar item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')
            ->where('is_active', true)
            ->orderBy('order');
    }

    /**
     * Get the parent of this navbar item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Get all root navbar items with their children (cached).
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getNavbarItems()
    {
        return Cache::remember('navbar_items', 3600, function () {
            return self::whereNull('parent_id')
                ->where('is_active', true)
                ->orderBy('order')
                ->with(['children' => function ($query) {
                    $query->orderBy('order');
                }])
                ->get();
        });
    }

    /**
     * Clear navbar cache.
     *
     * @return void
     */
    public static function clearCache()
    {
        Cache::forget('navbar_items');
    }
}
