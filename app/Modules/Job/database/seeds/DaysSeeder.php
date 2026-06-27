<?php

namespace Job\Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DaysSeeder extends Seeder
{
    public function run()
    {

        Schema::table('days', function () {
            DB::statement('
                SET foreign_key_checks = 0;
            ');
        });


        DB::table('days')->truncate();

        foreach ($this->data() as $s) {
            $status = new Day();
            $status->id = $s['id'];
            $status->name = $s['name'];
            $status->code = $s['code'];
            $status->short_name = $s['short_name'];
            $status->save();
        }
    }

    private function data()
    {
        return [
            [
                'id' => Day::SATURDAY,
                'name' => [
                    'ar' => 'السبت',
                    'en' => 'Saturday',
                    'de' => 'Samstag',
                ],
                'short_name' => [
                    'de' => 'Sat',
                    'en' => 'Sat',
                ],
                'code' => 'S',
            ],
            [
                'id' => Day::SUNDAY,
                'name' => [
                    'ar' => 'الأحد',
                    'en' => 'Sunday',
                    'de' => 'Sonntag',
                ],
                'short_name' => [
                    'de' => 'Sun',
                    'en' => 'Sun',
                ],
                'code' => 'U',
            ],
            [
                'id' => Day::MONDAY,
                'name' => [
                    'ar' => 'الإثنين',
                    'en' => 'Monday',
                    'de' => 'Montag',
                ],
                'short_name' => [
                    'de' => 'Mon',
                    'en' => 'Mon',
                ],
                'code' => 'M',
            ],
            [
                'id' => Day::TUESDAY,
                'name' => [
                    'ar' => 'الثلاثاء',
                    'en' => 'Tuesday',
                    'de' => 'Dienstag',
                ],
                'short_name' => [
                    'de' => 'Di',
                    'en' => 'Di',
                ],
                'code' => 'T',
            ],
            [
                'id' => Day::WEDNESDAY,
                'name' => [
                    'ar' => 'الأربعاء',
                    'en' => 'Wednesday',
                    'de' => 'Mittwoch',
                ],
                'short_name' => [
                    'de' => 'Marry',
                    'en' => 'Marry',
                ],
                'code' => 'W',
            ],
            [
                'id' => Day::THURSDAY,
                'name' => [
                    'ar' => 'الخميس',
                    'en' => 'Thursday',
                    'de' => 'Donnerstag ',
                ],
                'short_name' => [
                    'de' => 'Thu',
                    'en' => 'Thu',
                ],
                'code' => 'R',
            ],
            [
                'id' => Day::FRIDAY,
                'name' => [
                    'ar' => 'الجمعة',
                    'en' => 'Friday',
                    'de' => 'Freitag',
                ],
                'short_name' => [
                    'de' => 'Fri',
                    'en' => 'Fri',
                ],
                'code' => 'F',
            ],
        ];
    }
}
