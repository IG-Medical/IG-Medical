<?php

namespace User\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PermissionGroup extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    public const DASHBOARD = 1;
    public const PAGES = 2;
    public const ADMINS = 3;
    public const ROLES = 4;
    public const PERMISSIONS = 5;
    public const SETTINGS_GENERAL = 6;
    public const SETTINGS_MAINTENANCES = 7;
    public const SETTINGS_SITE = 8;
    public const SETTINGS_EMAIL = 9;
    public const SETTINGS_CUSTOM_CSS_JS = 10;
    public const APPEARANCE_GENERAL = 11;
    public const APPEARANCE_LOGO = 12;
    public const APPEARANCE_MENUS = 13;
    public const APPEARANCE_SOCIAL_LINKS = 14;
    public const APPEARANCE_CONTACT_INFO = 15;
    public const APPEARANCE_SLIDER = 16;


}
