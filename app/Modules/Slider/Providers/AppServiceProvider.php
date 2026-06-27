<?php

namespace Slider\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    public static $modulePath;
    public static $moduleName;
    public static $moduleNamePrefix;
    public static $moduleNamespace;

    private static function setModuleName()
    {
        self::$moduleName = basename(self::$modulePath);
    }

    private static function setModulePath()
    {
        self::$modulePath = dirname(__DIR__, 1);
    }

    private static function setModuleNamePrefix()
    {
        self::$moduleNamePrefix = Str::plural(lcfirst(self::$moduleName));
    }

    private static function setModuleNamespace()
    {
        self::$moduleNamespace = lcfirst(self::$moduleName);
    }

    private static function loadModule()
    {
        self::setModulePath();
        self::setModuleName();
        self::setModuleNamePrefix();
        self::setModuleNamespace();
    }

    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {
        self::loadModule();
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $moduleName = self::$moduleName;
        $moduleNamePrefix = self::$moduleNamePrefix;
        $moduleNamespace = self::$moduleNamespace;

        // define route file
        config([$moduleNamePrefix => File::getRequire(loadConfigFile(self::$moduleName))]);

        // load route in module
       // $this->loadRoutesFrom(loadRoute($moduleName));

        // load view in module
        $this->loadViewsFrom(loadViews($moduleName), $moduleNamespace);

        // load migrations in module
        $this->loadMigrationsFrom(loadMigrations($moduleName));

        // load translation file in lang
        $this->loadTranslationsFrom(loadLang($moduleName), $moduleNamespace);
    }


}
