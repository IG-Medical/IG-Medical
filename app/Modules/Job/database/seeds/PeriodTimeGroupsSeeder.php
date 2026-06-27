<?php


namespace Job\database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Job\Models\PeriodTimeGroup;


class PeriodTimeGroupsSeeder extends Seeder
{
    public function run()
    {

        Schema::table('period_time_groups', function () {
            DB::statement('
                SET foreign_key_checks = 0;
            ');
        });


        DB::table('period_time_groups')->truncate();

        foreach ($this->data() as $s) {
            $status = new PeriodTimeGroup();
            $status->id = $s['id'];
            $status->name = $s['name'];
            $status->is_active = $s['is_active'];
            $status->save();
        }
    }

    private function data()
    {
        return [
            [
                'id' => PeriodTimeGroup::DEFAULT_GROUP,
                'name' => [
                    'ar' => 'المجموعة الافتراضية',
                    'en' => 'default group',
                    'de' => 'Standardgruppe',
                ],
                'is_active' => YES,
            ],
        ];
    }
}
