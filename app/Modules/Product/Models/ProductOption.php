<?php

namespace Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function store($data, $productID)
    {
        if (count($data) > 0) {

            $currentOptions = ProductOption::where('product_id', $productID)->get();

            $option_ids = $currentOptions->pluck('option_id');

            ProductOption::where('product_id', $productID)->delete();
            Option::whereIn('id', $option_ids)->delete();
            OptionValue::whereIn('id', $option_ids)->delete();


            foreach ($data as $key => $option) {

                if (!empty($option['type'])) {

                    $newOption = Option::create([
                        'name' => $option['name'],
                        'type' => $option['type'],
                        'is_global' => NO
                    ]);

                    foreach ($option['values'] as $k => $v) {
                        OptionValue::create([
                            'option_id' => $newOption->id,
                            'label' => $v['label'],
                            'price' => $v['price'],
                        ]);
                    }

                    ProductOption::create([
                        'product_id' => $productID,
                        'option_id' => $newOption->id,
                    ]);
                }

            }
        }
    }

//    public static function _store($data, $productID)
//    {
//        if (count($data) > 0) {
//            foreach ($data as $key => $option) {
//
//                $optionID = isset($option['id']) ? $option['id'] : null;
//
//                if ($optionID) {
//
//                    $getOption = Option::find($optionID);
//
//                    if ($getOption) {
//                        $getOption->update([
//                            'name' => $option['name'],
//                            'type' => $option['type'],
//                        ]);
//                    }
//
//                    foreach ($option['values'] as $k => $v) {
//                        if (isset($v['id'])) {
//                            $value = OptionValue::find($v['id']);
//                            $value->update([
//                                'label' => $v['label'],
//                                'price' => $v['price'],
//                            ]);
//                        } else {
//                            OptionValue::create([
//                                'option_id' => $getOption->id,
//                                'label' => $v['label'],
//                                'price' => $v['price'],
//                            ]);
//                            ProductOption::create([
//                                'product_id' => $productID,
//                                'option_id' => $getOption->id,
//                            ]);
//                        }
//                    }
//
//                } else {
//                    $newOption = Option::create([
//                        'name' => $option['name'],
//                        'type' => $option['type'],
//                        'is_global' => NO
//                    ]);
//
//                    foreach ($option['values'] as $k => $v) {
//                        OptionValue::create([
//                            'option_id' => $newOption->id,
//                            'label' => $v['label'],
//                            'price' => $v['price'],
//                            'price_type' => $v['price_type'],
//                        ]);
//                    }
//
//                    ProductOption::create([
//                        'product_id' => $productID,
//                        'option_id' => $newOption->id,
//                    ]);
//                }
//            }
//        }
//    }

    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
