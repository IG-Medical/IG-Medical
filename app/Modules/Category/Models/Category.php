<?php

namespace Category\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Product\Models\Product;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations, SoftDeletes;

    public $translatable = ['name', 'short_description', 'description'];

    public const TYPE_PRODUCT = 1;
    public const TYPE_OPERATING_ROOM = 2;

    protected $appends = [
        'text',
        'opened',
        'selected',
        'disabled',
        'image_url',
        'icon_url',
        'breadcrumb_image_url',
        'breadcrumb_video_url',
        'order_number'
    ];

    public $guarded = [];

    public const DIR_UPLOADS = 'categories';

    public function getIconUrlAttribute($data)
    {
        $icon = null;
        if ($this->icon)
            $icon = assetUpload(self::DIR_UPLOADS . '/' . $this->icon);
        return $icon;
    }

    public static function getCategoriesFooter()
    {
        return Cache::remember('categoriesFooter', CACHE_TTL, function () {
            return self::where('is_active', YES)
                ->whereNotNull('parent_id')
                ->orderBy('order_number', 'asc')
                ->limit(7)
                ->get();
        });
    }

    public function getOrderNumberAttribute($value)
    {
        return $value ?? 0;
    }

    public static function getCategoriesHeader1()
    {
        return Cache::remember('categoriesHeader1', CACHE_TTL, function () {
            return self::where('is_active', YES)->where('parent_id', self::TYPE_PRODUCT)
                ->with('products')->orderBy('id', 'asc')->get();
        });
    }

    public static function getCategoriesHeader2()
    {
        return Cache::remember('categoriesHeader2', CACHE_TTL, function () {
            return self::where('is_active', YES)->where('parent_id', self::TYPE_OPERATING_ROOM)
                ->with('products')->orderBy('id', 'asc')->get();
        });
    }

    public function getImageUrlAttribute($data)
    {
        $image = null;
        if ($this->image)
            $image = assetUpload(self::DIR_UPLOADS . '/' . $this->image);
        return $image;
    }

    public function getBreadcrumbVideoUrlAttribute($data)
    {
        $video = null;
        if ($this->breadcrumb_video_type === 'youtube')
            $video = $this->breadcrumb_video;
        else
            if ($this->breadcrumb_video)
                $video = assetUpload(self::DIR_UPLOADS . '/' . $this->breadcrumb_video);
        return $video;
    }


    public function getBreadcrumbImageUrlAttribute($data)
    {
        $image = null;
        if ($this->breadcrumb_image)
            $image = assetUpload(self::DIR_UPLOADS . '/' . $this->breadcrumb_image);
        return $image;
    }

    public function getTextAttribute($data)
    {
        return $this->name;
    }

    public function getOpenedAttribute($data)
    {
        return true;
    }

    public function getSelectedAttribute($data)
    {
        return false;
    }

    public function getDisabledAttribute($data)
    {
        return false;
    }

    public function parent()
    {
        // return $this->belongsTo(Category::class, 'parent_id')->whereNull('parent_id')->with('parent');
        return $this->belongsTo(Category::class, 'parent_id')->with('parent');
    }

    public function parent1()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children');
    }

    public function children1()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', YES);
    }

    public function scopeSearchable($query)
    {
        return $query->where('is_searchable', YES);
    }

    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint)
    {
        return $query->whereHas($relation, $constraint)->with([$relation => $constraint]);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
//    public static function boot() {
//        parent::boot();
//
//        static::deleting(function($category) { // before delete() method call this
//            $category->children()->delete();
//            Cache::forget('categories');
//            Cache::forget('categoriesRoot');
//        });
//    }
}
