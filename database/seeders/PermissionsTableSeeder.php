<?php

namespace Database\Seeders;

use User\Models\Permission;
use User\Models\PermissionGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PermissionsTableSeeder extends Seeder
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
        Schema::table('permissions', function () {
            DB::statement('SET foreign_key_checks = 0;');
        });


        DB::table('permissions')->truncate();
    }

    private function insert()
    {
        foreach ($this->data() as $permission)
            Permission::create($permission);
    }

    private function data(): array
    {
        return [
            [
                'group_id' => PermissionGroup::DASHBOARD,
                'show_name' => [
                    'ar' => 'لوحة التحكم - الرئيسية',
                    'en' => 'Dashboard - Home',
                ],
                'name' => 'index-dashboard',
                'guard_name' => config('auth.defaults.guard')
            ],
            //===============================================
            [
                'group_id' => PermissionGroup::PAGES,
                'show_name' => [
                    'ar' => 'الصفحات - الرئيسية',
                    'en' => 'Pages - Home',
                ],
                'name' => 'index-page',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::PAGES,
                'show_name' => [
                    'ar' => 'اضافة صفحة جديدة',
                    'en' => 'Add a New Page',
                ],
                'name' => 'create-page',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::PAGES,
                'show_name' => [
                    'ar' => 'تعديل الصفحة',
                    'en' => 'Edit Page',
                ],
                'name' => 'edit-page',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::PAGES,
                'show_name' => [
                    'ar' => 'حذف الصفحة',
                    'en' => 'Delete Page',
                ],
                'name' => 'delete-page',
                'guard_name' => config('auth.defaults.guard'),
            ],
            //===============================================
            [
                'group_id' => PermissionGroup::ADMINS,
                'show_name' => [
                    'ar' => 'المشرفين - الرئيسية',
                    'en' => 'Admins - Home',
                ],
                'name' => 'index-admin',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::ADMINS,
                'show_name' => [
                    'ar' => 'اضافة مشرف جديد',
                    'en' => 'Add a New Admin',
                ],
                'name' => 'create-admin',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::ADMINS,
                'show_name' => [
                    'ar' => 'تعديل بيانات المشرف',
                    'en' => 'Edit Admin',
                ],
                'name' => 'edit-admin',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::ADMINS,
                'show_name' => [
                    'ar' => 'حذف المشرف',
                    'en' => 'Delete Admin',
                ],
                'name' => 'delete-admin',
                'guard_name' => config('auth.defaults.guard'),
            ],
            //===============================================
            [
                'group_id' => PermissionGroup::ROLES,
                'show_name' => [
                    'ar' => 'الأدوار - الرئيسية',
                    'en' => 'Roles - Home',
                ],
                'name' => 'index-role',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::ROLES,
                'show_name' => [
                    'ar' => 'اضافة دور جديد',
                    'en' => 'Add a New Role',
                ],
                'name' => 'create-role',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::ROLES,
                'show_name' => [
                    'ar' => 'تعديل بيانات الدور',
                    'en' => 'Edit Role',
                ],
                'name' => 'edit-role',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::ROLES,
                'show_name' => [
                    'ar' => 'حذف الدور',
                    'en' => 'Delete Role',
                ],
                'name' => 'delete-role',
                'guard_name' => config('auth.defaults.guard'),
            ],
            //===============================================
            [
                'group_id' => PermissionGroup::PERMISSIONS,
                'show_name' => [
                    'ar' => 'الأذونات - الرئيسية',
                    'en' => 'Permissions - Home',
                ],
                'name' => 'index-permission',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::PERMISSIONS,
                'show_name' => [
                    'ar' => 'اضافة دور أذن',
                    'en' => 'Add a New Permission',
                ],
                'name' => 'create-permission',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::PERMISSIONS,
                'show_name' => [
                    'ar' => 'تعديل بيانات الأذن',
                    'en' => 'Edit Permission',
                ],
                'name' => 'edit-permission',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::PERMISSIONS,
                'show_name' => [
                    'ar' => 'حذف الأذن',
                    'en' => 'Delete Permission',
                ],
                'name' => 'delete-permission',
                'guard_name' => config('auth.defaults.guard'),
            ],
            //===============================================
            [
                'group_id' => PermissionGroup::APPEARANCE_GENERAL,
                'show_name' => [
                    'ar' => 'المظهر - العام',
                    'en' => 'Appearance - General',
                ],
                'name' => 'index-general-appearance',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::APPEARANCE_GENERAL,
                'show_name' => [
                    'ar' => 'المظهر - تعديل عام',
                    'en' => 'Appearance - Edit General',
                ],
                'name' => 'edit-general-appearance',
                'guard_name' => config('auth.defaults.guard'),
            ],
            //===============================================
            [
                'group_id' => PermissionGroup::APPEARANCE_LOGO,
                'show_name' => [
                    'ar' => 'المظهر - الشعار',
                    'en' => 'Appearance - Logo',
                ],
                'name' => 'index-logo-appearance',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::APPEARANCE_LOGO,
                'show_name' => [
                    'ar' => 'المظهر - تعديل الشعار',
                    'en' => 'Appearance - Edit Logo',
                ],
                'name' => 'edit-logo-appearance',
                'guard_name' => config('auth.defaults.guard'),
            ],
            //===============================================
            [
                'group_id' => PermissionGroup::APPEARANCE_MENUS,
                'show_name' => [
                    'ar' => 'المظهر - القوائم',
                    'en' => 'Menus - Home',
                ],
                'name' => 'index-menu',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::APPEARANCE_MENUS,
                'show_name' => [
                    'ar' => 'اضافة قائمة جديدة',
                    'en' => 'Add a New Menu',
                ],
                'name' => 'create-menu',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::APPEARANCE_MENUS,
                'show_name' => [
                    'ar' => 'تعديل بيانات القائمة',
                    'en' => 'Edit Menu',
                ],
                'name' => 'edit-menu',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::APPEARANCE_MENUS,
                'show_name' => [
                    'ar' => 'حذف القائمة',
                    'en' => 'Delete Menu',
                ],
                'name' => 'delete-menu',
                'guard_name' => config('auth.defaults.guard'),
            ],
            //===============================================
            [
                'group_id' => PermissionGroup::APPEARANCE_SOCIAL_LINKS,
                'show_name' => [
                    'ar' => 'المظهر - روابط التواصل الاجتماعي',
                    'en' => 'Appearance - Social Links',
                ],
                'name' => 'index-social-links-appearance',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::APPEARANCE_SOCIAL_LINKS,
                'show_name' => [
                    'ar' => 'المظهر - تعديل روابط التواصل الأجتماعي',
                    'en' => 'Appearance - Edit Social Links',
                ],
                'name' => 'edit-social-links-appearance',
                'guard_name' => config('auth.defaults.guard'),
            ],
            //===============================================
            [
                'group_id' => PermissionGroup::APPEARANCE_CONTACT_INFO,
                'show_name' => [
                    'ar' => 'المظهر - بيانات التواصل',
                    'en' => 'Appearance - Contact Info',
                ],
                'name' => 'index-contact-info-appearance',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::APPEARANCE_CONTACT_INFO,
                'show_name' => [
                    'ar' => 'المظهر -تعديل بيانات التواصل',
                    'en' => 'Appearance - Edit Contact Info',
                ],
                'name' => 'edit-contact-info-appearance',
                'guard_name' => config('auth.defaults.guard'),
            ],
            //===============================================
            [
                'group_id' => PermissionGroup::APPEARANCE_SLIDER,
                'show_name' => [
                    'ar' => 'المظهر - السلايدر',
                    'en' => 'Appearance - Sliders',
                ],
                'name' => 'index-slider-appearance',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::APPEARANCE_SLIDER,
                'show_name' => [
                    'ar' => 'اضافة سلايدر جديد',
                    'en' => 'Add a New Slider',
                ],
                'name' => 'create-slider',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::APPEARANCE_SLIDER,
                'show_name' => [
                    'ar' => 'تعديل بيانات السلايدر',
                    'en' => 'Edit Slider',
                ],
                'name' => 'edit-slider',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::APPEARANCE_SLIDER,
                'show_name' => [
                    'ar' => 'حذف سلايدر',
                    'en' => 'Delete Slider',
                ],
                'name' => 'delete-slider',
                'guard_name' => config('auth.defaults.guard'),
            ],
            //===============================================
            [
                'group_id' => PermissionGroup::SETTINGS_GENERAL,
                'show_name' => [
                    'ar' => 'الإعدادات - عام',
                    'en' => 'Settings - General',
                ],
                'name' => 'index-general-settings',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::SETTINGS_GENERAL,
                'show_name' => [
                    'ar' => 'الإعدادات - تعديل عام',
                    'en' => 'Settings - Edit General',
                ],
                'name' => 'edit-general-settings',
                'guard_name' => config('auth.defaults.guard'),
            ],
            //===============================================
            [
                'group_id' => PermissionGroup::SETTINGS_EMAIL,
                'show_name' => [
                    'ar' => 'الإعدادات - البريد الإلكتروني ',
                    'en' => 'Settings - Email',
                ],
                'name' => 'index-email-settings',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::SETTINGS_EMAIL,
                'show_name' => [
                    'ar' => 'الإعدادات - تعديل البريد الإلكتروني ',
                    'en' => 'Settings - Edit Email',
                ],
                'name' => 'edit-email-settings',
                'guard_name' => config('auth.defaults.guard'),
            ],
            //===============================================
            [
                'group_id' => PermissionGroup::SETTINGS_CUSTOM_CSS_JS,
                'show_name' => [
                    'ar' => 'الإعدادات - تخصيص CSS/JS ',
                    'en' => 'Settings - Custom CSS/JS',
                ],
                'name' => 'index-custom-css-js-settings',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::SETTINGS_CUSTOM_CSS_JS,
                'show_name' => [
                    'ar' => 'الإعدادات -تعديل تخيص CSS/JS ',
                    'en' => 'Settings - Edit Custom CSS/JS',
                ],
                'name' => 'edit-custom-css-js-settings',
                'guard_name' => config('auth.defaults.guard'),
            ],
            //===============================================
            [
                'group_id' => PermissionGroup::SETTINGS_MAINTENANCES,
                'show_name' => [
                    'ar' => 'الإعدادات -الصيانة ',
                    'en' => 'Settings - Maintenances',
                ],
                'name' => 'index-maintenances-settings',
                'guard_name' => config('auth.defaults.guard'),
            ],
            [
                'group_id' => PermissionGroup::SETTINGS_MAINTENANCES,
                'show_name' => [
                    'ar' => 'الإعدادات - تعديل الصيانة ',
                    'en' => 'Settings - Edit Maintenances',
                ],
                'name' => 'edit-maintenances-settings',
                'guard_name' => config('auth.defaults.guard'),
            ],
            //===============================================

        ];
    }
}
