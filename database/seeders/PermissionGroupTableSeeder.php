<?php

namespace Database\Seeders;

use User\Models\PermissionGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PermissionGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->deleteData();

        $this->insert();
    }

    private function deleteData()
    {
        Schema::table('permission_groups', function () {
            DB::statement('
                SET foreign_key_checks = 0;
            ');
        });


        DB::table('permission_groups')->truncate();
    }

    private function insert()
    {
        foreach ($this->data() as $group)
            PermissionGroup::create($group);
    }

    private function data(): array
    {
        return [
            [
                'id' => PermissionGroup::DASHBOARD,
                'name' => [
                    'ar' => ' لوحة التحكم',
                    'en' => 'Dashboard',
                ]
            ],
            [
                'id' => PermissionGroup::PAGES,
                'name' => [
                    'ar' => 'الصفحات',
                    'en' => 'Pages',
                ]
            ],
            [
                'id' => PermissionGroup::ADMINS,
                'name' => [
                    'ar' => 'المشرفين',
                    'en' => 'Admins',
                ]
            ],
            [
                'id' => PermissionGroup::ROLES,
                'name' => [
                    'ar' => 'الأدوار',
                    'en' => 'Roles',
                ]
            ],
            [
                'id' => PermissionGroup::PERMISSIONS,
                'name' => [
                    'ar' => 'الأذونات',
                    'en' => 'Permissions',
                ]
            ],
            [
                'id' => PermissionGroup::APPEARANCE_GENERAL,
                'name' => [
                    'ar' => 'المظهر العام',
                    'en' => 'General Appearance',
                ]
            ],
            [
                'id' => PermissionGroup::APPEARANCE_LOGO,
                'name' => [
                    'ar' => 'الشعار',
                    'en' => 'Logo',
                ]
            ],
            [
                'id' => PermissionGroup::APPEARANCE_MENUS,
                'name' => [
                    'ar' => 'القوائم',
                    'en' => 'Menus',
                ]
            ],
            [
                'id' => PermissionGroup::APPEARANCE_SOCIAL_LINKS,
                'name' => [
                    'ar' => 'روابط السوشيل ميديا',
                    'en' => 'Social Links',
                ]
            ],
            [
                'id' => PermissionGroup::APPEARANCE_CONTACT_INFO,
                'name' => [
                    'ar' => 'بيانات الاتصال',
                    'en' => 'Contact Info',
                ]
            ],
            [
                'id' => PermissionGroup::SETTINGS_GENERAL,
                'name' => [
                    'ar' => 'إعدادات عامة',
                    'en' => 'General Settings',
                ]
            ],
            [
                'id' => PermissionGroup::SETTINGS_EMAIL,
                'name' => [
                    'ar' => 'إعدادات البريد الإلكتروني',
                    'en' => 'Email Settings',
                ]
            ],
            [
                'id' => PermissionGroup::SETTINGS_MAINTENANCES,
                'name' => [
                    'ar' => 'إعدادات الصيانة',
                    'en' => 'Maintenance Settings',
                ]
            ],
            [
                'id' => PermissionGroup::SETTINGS_CUSTOM_CSS_JS,
                'name' => [
                    'ar' => 'CSS/JS مخصص',
                    'en' => 'Custom CSS/JS',
                ]
            ]
        ];
    }
}
