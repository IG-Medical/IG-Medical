<?php


namespace User\Http\Controllers\AdminPanel;


use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use User\Providers\AppServiceProvider;

class CoreController extends Controller
{
    protected $model;
    protected $moduleDirView;
    protected $moduleNamespace;
    protected $moduleRoute;
    protected $subDirView;
    protected $asRoute;
    protected $route;
    protected $routeUrl;

    public function __construct(Model $model)
    {
        $this->moduleDirView = AppServiceProvider::$moduleNamespace . '::.' . ADMIN_VIEWS_DIR;
        $this->model = $model;
        $this->moduleNamespace = AppServiceProvider::$moduleNamespace;
        //$this->moduleRoute = AppServiceProvider::$moduleNamePrefix;
    }
}
