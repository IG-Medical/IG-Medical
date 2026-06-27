<?php


namespace Product\Http\Controllers\App;


//use Product\Models\Option;

use Category\Models\Category;

trait ProductTrait
{

//    private function getRadioOptionsProduct($product)
//    {
//        $array = [];
//        foreach($product->options as $option) {
//            if($option->type === Option::TYPE_CHECKBOX) {
//                $array[] = [
//                  'type' => $option->type,
//                  'type' => $option->type,
//                ];
//            }
//        }
//        return [];
//    }
//
//    private function getCheckboxOptionsProduct($product)
//    {
//        return [];
//    }

    private function breadcrumbs($product)
    {
        $sub_title0 = [];
        //$sub_title0 [route('product.index')] = trans_module_product('app.products');

        $sub_title = $sub_title0;
        $category1 = $product->category;

        if ($category1) {

            $sub_title1 [route('product.category', ['category' => $category1->slug])] = $category1->name;

            $sub_title = array_merge($sub_title, $sub_title1);

            $category2 = $category1->parent;

            if ($category2) {

                $sub_title2 = [];

                if ($category2->id === Category::TYPE_PRODUCT) {
                    $sub_title2 [route('product.showProductsPage')] = $category2->name;
                }

                if ($category2->id === Category::TYPE_OPERATING_ROOM) {
                    $sub_title2 [route('product.showOperatingRoomPage')] = $category2->name;
                }

                $sub_title = array_merge($sub_title, $sub_title2);

                $category3 = $category2->parent;

                if ($category3) {
                    $sub_title3 [route('product.category', ['category' => $category3->slug])] = $category3->name;

                    $sub_title = array_merge($sub_title, $sub_title3);
                }
            }
        }
        $sub_title = array_reverse($sub_title);
        $sub_title = array_merge($sub_title, [
            '' => $product->name,
        ]);

        return $sub_title;
    }

    private function getAttributesProduct($product)
    {
        $attributeSets = [];
        $attributes = null;
        $values = [];
        if (isset($product->attributes) && count($product->attributes) > 0) {

            foreach ($product->attributes as $key => $value) {

                $attribute = isset($value->attribute) ? $value->attribute : null;

                if ($attribute) {
                    $attributeSet = isset($attribute->attributeSet) ? $attribute->attributeSet : null;

                    $attributes[] = [
                        'attribute_product_id' => $value->id,
                        'id' => $attribute->id,
                        'name' => $attribute->name,
                        'attribute_set_id' => $attribute->attribute_set_id,
                        'attribute_set_name' => $attributeSet ? $attributeSet->name : null,
                    ];


                    if ($attributeSet) {
                        $attributeSets[] = [
                            'id' => $attributeSet->id,
                            'name' => $attributeSet->name,
                        ];
                    }

                }
                $value = isset($value->productAttributeValues) ? $value->productAttributeValues : [];

                if ($value) {

                    foreach ($value as $k => $v) {

                        $values[] = [
                            'id' => $v['id'],
                            'name' => $v->value->name,
                            'attribute_id' => $v->value->attribute_id
                        ];
                    }
                }
            }

        }


        $group_by_values = collect($values)->groupBy('attribute_id')->toArray();
        $group_by_attribute = collect($attributes)->groupBy('attribute_set_id')->toArray();

        return [
            'attribute' => $group_by_attribute,
            'values' => $group_by_values,
        ];
    }

}
