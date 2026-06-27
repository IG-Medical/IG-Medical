<?php
if (!function_exists('getModulePath')) {
    function getModulePath(string $moduleName)
    {
        return app_path('Modules' . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR);
    }
}

if (!function_exists('getModuleName')) {
    function getModuleName()
    {
        return basename(dirname(__DIR__, 1));
    }
}

if (!function_exists('loadRoute')) {
    function loadRoute(string $moduleName, string $fileName = 'web')
    {
        return getModulePath($moduleName) . 'routes' . DIRECTORY_SEPARATOR . $fileName . '.php';
    }
}

if (!function_exists('loadViews')) {
    function loadViews(string $moduleName)
    {
        return getModulePath($moduleName) . 'resources' . DIRECTORY_SEPARATOR . 'views';
    }
}


if (!function_exists('loadLang')) {
    function loadLang(string $moduleName)
    {
        return getModulePath($moduleName) . 'resources' . DIRECTORY_SEPARATOR . 'lang';
    }
}

if (!function_exists('loadMigrations')) {
    function loadMigrations(string $moduleName)
    {
        return getModulePath($moduleName) . 'database' . DIRECTORY_SEPARATOR . 'migrations';
    }
}

if (!function_exists('loadConfigFile')) {

    function loadConfigFile(string $moduleName, string $fileName = 'app')
    {
        return getModulePath($moduleName) . 'config' . DIRECTORY_SEPARATOR . $fileName . '.php';
    }
}


if (!function_exists('buildModulePrefix')) {
    function buildModulePrefix(string $moduleName, string $key)
    {
        return config($moduleName . '.prefix.' . $key, config($moduleName . '.prefix.' . $key)) . '/' . $moduleName;
    }
}

if (!function_exists('buildNamespace')) {
    function buildNamespace(string $moduleName)
    {
        return $moduleName . '\Http\Controllers';
    }
}

if (!function_exists('buildModuleNamespace')) {
    function buildModuleNamespace(string $moduleName, string $key)
    {
        return config($moduleName . '.namespace.' . $key, config($moduleName . '.namespace.' . $key));
    }
}
