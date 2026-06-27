<?php

namespace Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function store($data, $productID)
    {
        $attribute_ids = [];

        $values = [];
        $save = false;

        if (count($data) > 0) {

            $queryProductAttribute = self::where('product_id', $productID);
            $getProductAttribute = $queryProductAttribute->select('id')->get();

            $productAttributeIDS = [];

            foreach ($getProductAttribute as $key => $value) {
                $productAttributeIDS[] = $value->id;
            }

            $queryProductAttribute->delete();

            ProductAttributeValues::whereIn('product_attribute_id', $productAttributeIDS)->delete();

            foreach ($data as $key => $value) {
                $attribute_ids = [
                    'product_id' => $productID,
                    'attribute_id' => $value['attribute_id'],
                ];

                $productAttribute = self::create($attribute_ids);

                foreach ($value['values'] as $v) {
                    $values[] = [
                        'product_attribute_id' => $productAttribute->id,
                        'attribute_value_id' => $v,
                    ];
                }
            }
            $save = ProductAttributeValues::insert($values);
        }

        return $save;
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productAttributeValues()
    {
        return $this->hasMany(ProductAttributeValues::class, 'product_attribute_id');
    }
}
