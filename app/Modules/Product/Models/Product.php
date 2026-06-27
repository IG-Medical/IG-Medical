<?php

namespace Product\Models;

use Category\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations, SoftDeletes;

    public $translatable = ['name', 'short_description', 'description','basic_configuration'];

    protected $appends = [
        'icon_url',
        'pdf_url',
        'main_image_url',
        'price_after_discount',
        'status',
        'status_id',
       // 'show_price',
      //  'show_price_after_discount',
        'status_qty'
    ];

    public $guarded = [];

    public const STATUS_NEW = 1;
    public const STATUS_OUT_OF_STOCK = 2;

    public static function getProductsFooter()
    {
        return Cache::remember('productsFooter', CACHE_TTL, function () {
            return self::whereNull('product_id')->limit(5)->get();
        });
    }

    public static function getProductsHeader1()
    {
        return Cache::remember('productsHeader1', CACHE_TTL, function () {
            return self::whereNull('product_id')->where('category_id', Category::TYPE_PRODUCT)->get();
        });
    }

    public static function getProductsHeader2()
    {
        return Cache::remember('productsHeader2', CACHE_TTL, function () {
            return self::whereNull('product_id')->where('category_id', Category::TYPE_OPERATING_ROOM)->get();
        });
    }

    public function getStatusIdAttribute($data)
    {
        $status = null;
        $qty = $this->qty;

        if ($this->is_new)
            $status = self::STATUS_NEW;

        if ($qty <= 0 || is_null($qty))
            $status = self::STATUS_OUT_OF_STOCK;

        return $status;
    }

    public function getStatusAttribute($data)
    {
        $status = null;
        $qty = $this->qty;

//        if ($this->is_new)
//            $status = trans_module_product('admin.new');

        if ($qty <= 0 || is_null($qty))
            $status = trans_module_product('app.out_of_stock');

        return $status;
    }

    public function getStatusQtyAttribute($data)
    {
        $status = trans_module_product('app.in_of_stock');
        $qty = $this->qty;

        if ($qty <= 0 || is_null($qty))
            $status = trans_module_product('app.out_of_stock');

        return $status;
    }


    public function getMainImageUrlAttribute($data)
    {
        $main_image = null;
        if ($this->main_image)
            $main_image = assetUpload(ProductAttachments::DIR_UPLOADS . '/' . $this->main_image);
        return $main_image;
    }

    public function getIconUrlAttribute($data)
    {
        $icon = null;
        if ($this->icon)
            $icon = assetUpload(ProductAttachments::DIR_UPLOADS . '/' . $this->icon);
        return $icon;
    }

    public function getPdfUrlAttribute($data)
    {
        $pdf = null;
        if ($this->pdf)
            $pdf= assetUpload(ProductAttachments::DIR_UPLOADS . '/' . $this->pdf);
        return $pdf;
    }

    public function getPriceAfterDiscountAttribute($data)
    {
        $price = $this->price;
        $discount_percentage = $this->discount_percentage;
        if ($discount_percentage > 0)
            $price = calculate_total_after_discount($price, $discount_percentage);
        return round($price, 2);
    }


    public function gallery()
    {
        return $this->hasMany(ProductAttachments::class, 'product_id');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'product_options', 'product_id', 'option_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', YES);
    }

    public function scopeQty($query)
    {
        return $query->where('qty', '>', 0);
    }

    public function scopeDiscount($query)
    {
        return $query->whereNotNull('discount_percentage');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function banners()
    {
        return $this->belongsToMany(\App\Models\Banner::class, 'banner_product')
            ->withPivot('position');
    }
}
