<?php
namespace Job\Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Job\Models\CareerStatus;

class CareerStatusSeeder extends Seeder
{
    public function run()
    {

        Schema::table('career_statuses', function () {
            DB::statement('
                SET foreign_key_checks = 0;
            ');
        });


        DB::table('career_statuses')->truncate();

        foreach ($this->statuses() as $s) {
            $status = new CareerStatus();
            $status->id = $s['id'];
            $status->name = $s['name'];
            $status->save();
        }
    }

    private function statuses()
    {
        return [
            [
                'id' => CareerStatus::IN_REVIEW,
                'name' => [
                    'ar' => 'قيد المراجعة',
                    'en' => 'In Review',
                ],
                'description' => null,
            ],
            [
                'id' => CareerStatus::OPEN,
                'name' => [
                    'ar' => 'مفتوح',
                    'en' => 'Open',
                ],
                'description' => null,
            ],
            [
                'id' => CareerStatus::ARCHIVED,
                'name' => [
                    'ar' => 'مؤرشف',
                    'en' => 'Archived',
                ],
                'description' => null,
            ],
            [
                'id' => CareerStatus::REJECTED,
                'name' => [
                    'ar' => 'مرفوض',
                    'en' => 'Rejected',
                ],
                'description' => null,
            ],
            [
                'id' => CareerStatus::CLOSED,
                'name' => [
                    'ar' => 'مغلق',
                    'en' => 'Closed',
                ],
                'description' => null,
            ],
            [
                'id' => CareerStatus::CANCELED,
                'name' => [
                    'ar' => 'ألغيت',
                    'en' => 'Canceled',
                ],
                'description' => null,
            ],
            [
                'id' => CareerStatus::DRAFT,
                'name' => [
                    'ar' => 'مسودة',
                    'en' => 'Draft',
                ],
                'description' => null,
            ],
        ];
    }
}
