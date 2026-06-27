<?php
namespace Database\Seeders;

use User\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserTypeSeeder extends Seeder
{
    public function run()
    {
        $this->deleteData();

        $this->insert();
    }

    private function insert()
    {
        foreach ($this->data() as $row)
            UserType::create($row);
    }

    private function deleteData()
    {
        Schema::table('user_types', function () {
            DB::statement('
                SET foreign_key_checks = 0;
            ');
        });

        DB::table('user_types')->truncate();
    }

    private function data(): array
    {
        return [
            [
                'id' => UserType::ADMIN,
                'name' => 'Admin',
                'slug' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => UserType::NORMAL,
                'name' => 'Normal',
                'slug' => 'normal',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
    }
}
