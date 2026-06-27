<?php


namespace Job\database\seeds;

use App\Models\PeriodTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Job\Models\PeriodTimeGroup;


class PeriodTimeSeeder extends Seeder
{
    public function run()
    {

        Schema::table('period_times', function () {
            DB::statement('
                SET foreign_key_checks = 0;
            ');
        });


        DB::table('period_times')->truncate();

        foreach ($this->data() as $s) {
            $status = new PeriodTime();
            //$status->id = $s['id'];
            $status->name = $s['name'];
            $status->period_time_group_id = $s['period_time_group_id'];
            $status->save();
        }
    }

    private function data()
    {
        return [
            [
                'name' => [
                    'de' => 'Morning',
                ],
                'period_time_group_id' => PeriodTimeGroup::DEFAULT_GROUP,
            ],
            [
                'name' => [
                    'de' => 'Lunch',
                ],
                'period_time_group_id' => PeriodTimeGroup::DEFAULT_GROUP,
            ],
            [
                'name' => [
                    'de' => 'Evening',
                ],
                'period_time_group_id' => PeriodTimeGroup::DEFAULT_GROUP,
            ],
            [
                'name' => [
                    'de' => 'At night',
                ],
                'period_time_group_id' => PeriodTimeGroup::DEFAULT_GROUP,
            ],
        ];
    }
}
