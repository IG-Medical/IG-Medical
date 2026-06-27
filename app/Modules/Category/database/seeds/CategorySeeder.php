<?php
namespace Category\Database\Seeders;

use Category\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $this->deleteData();

        $this->insert();
    }

    private function insert()
    {
        foreach ($this->data() as $row)
            Category::create($row);
    }

    private function deleteData()
    {
        Schema::table('categories', function () {
            DB::statement('
                SET foreign_key_checks = 0;
            ');
        });

        DB::table('categories')->truncate();
    }

    private function data(): array
    {
        return [
            [
                'id' => Category::TYPE_PRODUCT,
                'name' => [
                    'en' => 'Products',
                    'de' => 'Products',
                ],
                'slug' => 'products',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => Category::TYPE_OPERATING_ROOM,
                'name' => [
                    'en' => 'Operating Room',
                    'de' => 'Operating Room',
                ],
                'slug' => 'operating',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
    }
}
