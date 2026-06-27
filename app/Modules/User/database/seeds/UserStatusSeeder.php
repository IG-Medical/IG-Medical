<?php
namespace User\Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use User\Models\UserStatus;
use Illuminate\Database\Seeder;

class UserStatusSeeder extends Seeder
{
    public function run()
    {
        Schema::table('user_statuses', function () {
            DB::statement('
                SET foreign_key_checks = 0;
            ');
        });

        DB::table('user_statuses')->truncate();

        foreach ($this->statuses() as $s) {
            $status = new UserStatus();
            $status->id = $s['id'];
            $status->name = $s['name'];
            $status->save();
        }
    }

    private function statuses()
    {
        return [
            [
                'id' => UserStatus::PENDING,
                'name' => [
                    'ar' => 'قيد المراجعة',
                    'en' => 'In Review',
                    'es' => '',
                ],
                'code' => 'in_review',
                'description' => null,
            ],
            [
                'id' => UserStatus::ACCEPTED,
                'name' => [
                    'ar' => 'قبلت',
                    'en' => 'Accepted',
                    'es' => '',
                ],
                'code' => 'accepted',
                'description' => null,
            ],
            [
                'id' => UserStatus::ACTIVATED,
                'name' => [
                    'ar' => 'فعال',
                    'en' => 'Activated',
                    'es' => '',
                ],
                'code' => 'activated',
                'description' => null,
            ],
            [
                'id' => UserStatus::REJECTED,
                'name' => [
                    'ar' => 'مرفوض',
                    'en' => 'Rejected',
                    'es' => '',
                ],
                'code' => 'rejected',
                'description' => null,
            ],
            [
                'id' => UserStatus::BLOCKED,
                'name' => [
                    'ar' => 'محظور',
                    'en' => 'Blocked',
                    'es' => '',
                ],
                'code' => 'blocked',
                'description' => null,
            ],
            [
                'id' => UserStatus::DEACTIVATED,
                'name' => [
                    'ar' => 'معطل',
                    'en' => 'Disabled',
                    'es' => '',
                ],
                'code' => 'disabled',
                'description' => null,
            ],
        ];
    }
}
