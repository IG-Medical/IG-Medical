<?php


use Banner\Models\Banner;
use Setting\Models\Setting;

define('PAGE_GENERAL', Setting::PAGE_GENERAL);
define('PAGE_HOME_PAGE', Setting::PAGE_HOME_PAGE);
define('PAGE_MAINTENANCE', Setting::PAGE_MAINTENANCE);
define('PAGE_SITE', Setting::PAGE_SITE);
define('PAGE_MAIL', Setting::PAGE_MAIL);
define('PAGE_CUSTOM_CSS_JS', Setting::PAGE_CUSTOM_CSS_JS);
define('PAGE_SOCIAL_MEDIA_LINKS', Setting::PAGE_SOCIAL_MEDIA_LINKS);
define('PAGE_LOGO', Setting::PAGE_LOGO);
define('PAGE_CONTACT_INFO', Setting::PAGE_CONTACT_INFO);
define('PAGE_ABOUT_US', Setting::PAGE_ABOUT_US);
define('PAGE_FEATURES', Setting::PAGE_FEATURES);
define('PAGE_CERTIFICATIONS', Setting::PAGE_CERTIFICATIONS);
define('PAGE_BREADCRUMBS', Setting::PAGE_BREADCRUMBS);
define('PAGE_TITLES', Setting::PAGE_PAGE_TITLES);

if (!function_exists('is_set')) {
    function is_set($data)
    {
        return isset($data) ? $data : null;
    }
}


if (!function_exists('get_banner')) {
    function getBanner($page, $position)
    {
        $banners = Banner::getBanners();
        $banner = $banners->where('page', $page)->where('position', $position)->where('is_active', YES)->first();
        return $banner ? $banner : null;
    }
}

if (!function_exists('getSetting')) {
    function getSetting($key)
    {
        $setting = getSettings();

        if (is_array($key)) {
            $setting = $setting->whereIn('key', $key);
            return $setting;
        }

        $setting = $setting->where('key', $key)->first();
        return isset($setting) ? $setting->value : null;
    }
}

if (!function_exists('getSettings')) {
    function getSettings()
    {
        return Setting::getSettings();
    }
}

if (!function_exists('userFemaleImageDefault')) {
    function userFemaleImageDefault()
    {
        return asset('images/user_default.png');
    }
}

if (!function_exists('userMaleImageDefault')) {
    function userMaleImageDefault()
    {
        return asset('images/user_default.png');
    }
}

if (!function_exists('user_default')) {
    function user_default()
    {
        return asset('images/user_default.png');
    }
}
