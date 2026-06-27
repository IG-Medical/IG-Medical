<?php

namespace Job\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Job\Models\RequestStatus;

class RequestStatusSeeder extends Seeder
{
    public function run()
    {
        Schema::table('request_statuses', function () {
            DB::statement('
                SET foreign_key_checks = 0;
            ');
        });

        DB::table('request_statuses')->truncate();

        foreach ($this->requestStatuses() as $s) {
            $status = new RequestStatus();
            $status->id = $s['id'];
            $status->name = $s['name'];
            $status->save();
        }
    }

    private function requestStatuses()
    {
        return [
            [
                'id' => RequestStatus::PENDING,
                'name' => [
                    'ar' => 'قيد الانتظار',
                    'en' => 'Pending',
                    'es' => '',
                ],
                'code' => 'pending',
                'description' => null,
            ],
            [
                'id' => RequestStatus::ACCEPTED,
                'name' => [
                    'ar' => 'قبلت',
                    'en' => 'Accepted',
                    'es' => '',
                ],
                'code' => 'accepted',
                'description' => null,
            ],
            [
                'id' => RequestStatus::REJECTED,
                'name' => [
                    'ar' => 'مرفوض',
                    'en' => 'Rejected',
                    'es' => '',
                ],
                'code' => 'rejected',
                'description' => null,
            ],
            [
                'id' => RequestStatus::CLOSED,
                'name' => [
                    'ar' => 'مغلق',
                    'en' => 'Closed',
                    'es' => '',
                ],
                'code' => 'close',
                'description' => null,
            ],
            [
                'id' => RequestStatus::CANCELED,
                'name' => [
                    'ar' => 'ملغي',
                    'en' => 'Canceled',
                    'es' => '',
                ],
                'code' => 'canceled',
                'description' => null,
            ],
        ];
    }
}
