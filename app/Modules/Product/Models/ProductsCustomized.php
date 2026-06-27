<?php

namespace Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsCustomized extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
