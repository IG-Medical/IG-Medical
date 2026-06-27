<?php

namespace Database\Seeders;

use App\Models\NavbarItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavbarItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        NavbarItem::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create only parent/root navbar items according to header.blade.php
        // Order matches the appearance in the header

        // 1. Home - trans('app.home')
        NavbarItem::create([
            'title' => 'Home',
            'slug' => '/',
            'parent_id' => null,
            'order' => 0,
            'is_active' => true,
        ]);

        // 2. Products - trans('app.products') - dropdown with dynamic categoryHeader1
        NavbarItem::create([
            'title' => 'Products',
            'slug' => '/products',
            'parent_id' => null,
            'order' => 1,
            'is_active' => true,
        ]);

        // 3. Operating Room - trans('app.operating_room') - dropdown with dynamic categoryHeader2
        NavbarItem::create([
            'title' => 'Operating Room',
            'slug' => '/operating-room',
            'parent_id' => null,
            'order' => 2,
            'is_active' => true,
        ]);

        // 4. Company - trans('app.company') - dropdown
        NavbarItem::create([
            'title' => 'Company',
            'slug' => '/company',
            'parent_id' => null,
            'order' => 3,
            'is_active' => true,
        ]);

        // 5. News - trans('app.news')
        NavbarItem::create([
            'title' => 'News',
            'slug' => '/news',
            'parent_id' => null,
            'order' => 4,
            'is_active' => true,
        ]);

        // 6. Contact - trans('app.contact') - dropdown
        NavbarItem::create([
            'title' => 'Contact',
            'slug' => '/contact-us',
            'parent_id' => null,
            'order' => 5,
            'is_active' => true,
        ]);

        // Clear cache after seeding
        NavbarItem::clearCache();
    }
}
