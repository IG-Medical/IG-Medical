<?php

namespace Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeValues extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function value()
    {
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id');
    }

    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id');
    }
}
