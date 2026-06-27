<?php
if (!function_exists('trans_module_page')) {
    function trans_module_page($text, $params = [], $locale = null)
    {
        return trans(\Page\Providers\AppServiceProvider::$moduleNamespace . "::" . $text, $params, $locale);
    }
}
if (!function_exists('trans_module_slider')) {
    function trans_module_slider($text, $params = [], $locale = null)
    {
        return trans(\Slider\Providers\AppServiceProvider::$moduleNamespace . "::" . $text, $params, $locale);
    }
}
if (!function_exists('trans_module_contact_us')) {
    function trans_module_contact_us($text, $params = [], $locale = null)
    {
        return trans(\Contact\Providers\AppServiceProvider::$moduleNamespace . "::" . $text, $params, $locale);
    }
}
if (!function_exists('trans_module_category')) {
    function trans_module_category($text, $params = [], $locale = null)
    {
        return trans(\Category\Providers\AppServiceProvider::$moduleNamespace . "::" . $text, $params, $locale);
    }
}
if (!function_exists('trans_module_product')) {
    function trans_module_product($text, $params = [], $locale = null)
    {
        return trans(\Product\Providers\AppServiceProvider::$moduleNamespace . "::" . $text, $params, $locale);
    }
}
if (!function_exists('trans_module_job')) {
    function trans_module_job($text, $params = [], $locale = null)
    {
        return trans(\Job\Providers\AppServiceProvider::$moduleNamespace . "::" . $text, $params, $locale);
    }
}
if (!function_exists('trans_module_testimonial')) {
    function trans_module_testimonial($text, $params = [], $locale = null)
    {
        return trans(\Testimonial\Providers\AppServiceProvider::$moduleNamespace . "::" . $text, $params, $locale);
    }
}
if (!function_exists('trans_module_setting')) {
    function trans_module_setting($text, $params = [], $locale = null)
    {
        return trans(\Setting\Providers\AppServiceProvider::$moduleNamespace . "::" . $text, $params, $locale);
    }
}
if (!function_exists('trans_module_news')) {
    function trans_module_news($text, $params = [], $locale = null)
    {
        return trans(\News\Providers\AppServiceProvider::$moduleNamespace . "::" . $text, $params, $locale);
    }
}
if (!function_exists('trans_module_distributor')) {
    function trans_module_distributor($text, $params = [], $locale = null)
    {
        return trans(\Distributor\Providers\AppServiceProvider::$moduleNamespace . "::" . $text, $params, $locale);
    }
}
if (!function_exists('trans_module_user')) {
    function trans_module_user($text, $params = [], $locale = null)
    {
        return trans(\User\Providers\AppServiceProvider::$moduleNamespace . "::" . $text, $params, $locale);
    }
}
