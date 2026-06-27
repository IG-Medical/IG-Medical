<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Product\Models\Product;

class BannersTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Banner::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $products = Product::whereNull('product_id')->limit(6)->get();

        if ($products->count() >= 2) {
            $banner1 = Banner::create([
                'title' => 'Featured Products Banner',
                'page' => 'home',
                'image' => 'banner1.jpg',
                'link' => '/products',
                'position' => 0,
                'is_active' => true,
            ]);

            if ($products->count() >= 4) {
                $sync1 = [];
                foreach ($products->take(4) as $index => $product) {
                    $sync1[$product->id] = ['position' => $index];
                }
                $banner1->products()->sync($sync1);
            }

            $banner2 = Banner::create([
                'title' => 'Special Offer Banner',
                'page' => 'home',
                'image' => 'banner2.jpg',
                'link' => '/special-offers',
                'position' => 1,
                'is_active' => true,
            ]);

            if ($products->count() >= 6) {
                $sync2 = [];
                foreach ($products->skip(4)->take(2) as $index => $product) {
                    $sync2[$product->id] = ['position' => $index];
                }
                $banner2->products()->sync($sync2);
            }
        }
    }
}
