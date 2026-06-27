<?php


namespace Page\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Page\Models\Page;

class PagesTableSeeder extends Seeder
{
    public function run()
    {
        $this->deleteData();

        $this->insert();
    }

    private function deleteData()
    {
        Schema::table('pages', function () {
            DB::statement('
                SET foreign_key_checks = 0;
            ');
        });

        DB::table('pages')->truncate();
    }

    private function insert()
    {
        foreach ($this->data() as $row)
            Page::create($row);
    }

    private function data(): array
    {
        return [
            [
                'title' => [
                    'en' => 'Privacy Policy',
                    'de' => 'Datenschutzrichtlinie',
                ],
                'slug' => 'privacy-policy',
                'content' => [
                    'de' => '',
                    'en' => '',
                ],
            ],
            [
                'title' => [
                    'en' => 'Terms of Use',
                    'de' => 'Terms of Use',
                ],
                'slug' => 'terms-of-use',
                'content' => [
                    'de' => '',
                    'en' => '',
                ],
            ],
            [
                'title' => [
                    'en' => 'Quality',
                    'de' => 'Quality',
                ],
                'slug' => 'about-us',
                'content' => [
                    'en' => '',
                    'de' => '',
                ],
            ],
            [
                'title' => [
                    'en' => 'R&D',
                    'de' => 'R&D',
                ],
                'slug' => 'r-and-d',
                'content' => [
                    'en' => '',
                    'de' => '',
                ],
            ],
            [
                'title' => [
                    'en' => 'Sales',
                    'de' => 'Sales',
                ],
                'slug' => 'sales',
                'content' => [
                    'en' => '',
                    'de' => '',
                ],
            ],
            [
                'title' => [
                    'en' => 'Technical',
                    'de' => 'Technical',
                ],
                'slug' => 'technical',
                'content' => [
                    'en' => '',
                    'de' => '',
                ],
            ],
            [
                'title' => [
                    'en' => 'QM',
                    'de' => 'QM',
                ],
                'slug' => 'qm',
                'content' => [
                    'en' => '',
                    'de' => '',
                ],
            ],
            [
                'title' => [
                    'en' => 'imprint',
                    'de' => 'imprint',
                ],
                'slug' => 'imprint',
                'content' => [
                    'en' => '',
                    'de' => '',
                ],
            ],
            [
                'title' => [
                    'en' => 'conditions',
                    'de' => 'conditions',
                ],
                'slug' => 'conditions',
                'content' => [
                    'en' => '',
                    'de' => '',
                ],
            ],
            [
                'title' => [
                    'en' => 'Data Protection',
                    'de' => 'Data Protection',
                ],
                'slug' => 'data-protection',
                'content' => [
                    'en' => '',
                    'de' => '',
                ],
            ],
        ];
    }

}
