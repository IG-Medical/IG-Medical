<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Category\Models\Category;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'page',
        'image',
        'link',
        'position',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'position' => 'integer',
    ];

    protected $guarded = [];

    public const DIR_UPLOADS = 'banners';

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'banner_category')
            ->withPivot('position')
            ->orderBy('banner_category.position');
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }
        return assetUpload(self::DIR_UPLOADS . '/' . $this->image);
    }
}
