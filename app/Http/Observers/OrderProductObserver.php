<?php

namespace App\Http\Observers;


use Order\Models\OrderProduct;
use Product\Models\Product;

class OrderProductObserver
{

    public function created(OrderProduct $order)
    {
//        $product = Product::find($order->product_id);
//        $product->number_of_sales = $product->number_of_sales + 1;
//        $product->qty = $product->qty - $order->qty;
//        $product->save();
    }


    public function updated(OrderProduct $order)
    {
    }


    public function deleted(OrderProduct $order)
    {

    }


    public function restored(OrderProduct $order)
    {
        //
    }


    public function forceDeleted(OrderProduct $order)
    {
        //
    }
}
