<?php

namespace Job\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{

    public function boot()
    {
        parent::boot();
    }


    public function map()
    {
        $this->mapApiRoutes();

        $this->mapAppRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();
    }

    protected function mapAppRoutes()
    {
        $locale = request()->segment(1);

        Route::prefix($locale)
            ->middleware('app')
            ->namespace($this->getModuleNamespace() . DS . APP_NAMESPACE)
            ->as(APP_ROUTE . '.' . AppServiceProvider::$moduleNamespace . '.')
            ->group($this->getModulePath() . '/routes/app.php');
    }


    protected function mapAdminRoutes()
    {
        $locale = request()->segment(1);

        Route::prefix($locale . '/' . ADMIN_PREFIX)
            ->middleware('admin')
            ->namespace($this->getModuleNamespace() . DS . ADMIN_NAMESPACE)
            ->as(ADMIN_ROUTE . '.')
            ->group($this->getModulePath() . '/routes/admin.php');
    }

    protected function mapWebRoutes()
    {
        $locale = request()->segment(1);

        Route::prefix($locale)
            ->middleware('web')
            ->namespace($this->getModuleNamespace())
            ->group($this->getModulePath() . '/routes/web.php');
    }


    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->getModuleNamespace())
            ->group($this->getModulePath() . '/routes/api.php');
    }

    private function getModuleNamespace()
    {
        return buildNamespace(AppServiceProvider::$moduleName);
    }

    private function getModulePath()
    {
        return AppServiceProvider::$modulePath;
    }
}
