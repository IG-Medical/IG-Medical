<?php

namespace Database\Seeders;

use Category\Database\Seeders\CategorySeeder;
use Illuminate\Database\Seeder;
use Page\Database\Seeders\PagesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            PermissionGroupTableSeeder::class,
            PermissionsTableSeeder::class,
            UserTypeSeeder::class,
            UserStatusSeeder::class,
            AdminsTableSeeder::class,
            PagesTableSeeder::class,
            CategorySeeder::class,
            CountryMultiLanguagesSeeder::class,
        ]);
    }
}
