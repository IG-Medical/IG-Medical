<?php

namespace Contact\Models;

use Illuminate\Database\Eloquent\Model;
use Product\Models\Product;

class ContactUs extends Model
{

    protected $table = 'contact_us';
    protected $guarded = [];

    public const STATUS_OPEN = 1;

    public const STATUS_ARCHIVED = 2;


    public static function status($status)
    {
        return $status === self::STATUS_OPEN ? trans_module_contact_us('admin.open') : trans_module_contact_us('admin.archived');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'favorite_product');
    }
}
