<?php

namespace Page\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapAppRoutes();

        $this->mapAdminRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAppRoutes()
    {
        $locale = request()->segment(1);

        Route::prefix($locale)
            ->middleware('app')
            ->namespace($this->getModuleNamespace() . DS . APP_NAMESPACE)
            ->group($this->getModulePath() . '/routes/app.php');
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        $locale = request()->segment(1);

        Route::prefix($locale . '/' . ADMIN_PREFIX)
            ->middleware('admin')
            ->namespace($this->getModuleNamespace() . DS . ADMIN_NAMESPACE)
            ->as(ADMIN_ROUTE . '.')
            ->group($this->getModulePath() . '/routes/admin.php');
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
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
