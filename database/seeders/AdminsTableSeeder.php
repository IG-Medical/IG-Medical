<?php


namespace Database\Seeders;

use User\Models\Role;
use User\Models\User;
use User\Models\UserStatus;
use User\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminsTableSeeder extends Seeder
{
    public function run()
    {
        $this->deleteData();

        $this->insert();
    }

    private function deleteData()
    {
        Schema::table('users', function () {
            DB::statement('
                SET foreign_key_checks = 0;
            ');
        });

        DB::table('users')->truncate();
    }

    private function insert()
    {
        foreach ($this->data() as $row)
            User::create($row);
    }

    private function data(): array
    {
        return [
            [
                'full_name' => 'admin admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('asdASD123!@#'),
                'uniq_id' => generateUniqId(),
                'role_id' => Role::ADMINISTRATION,
                'user_type_id' => UserType::ADMIN,
                'status_id' => UserStatus::ACCEPTED
            ],
        ];
    }

}
