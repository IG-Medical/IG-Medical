<?php


namespace Product\Http\Controllers\App;


use App\Http\Controllers\Controller;
use Product\Providers\AppServiceProvider;

class CoreController extends Controller
{

    protected $model;
    protected $moduleDirView;
    protected $moduleNamespace;
    protected $moduleRoute;

    public function __construct()
    {
        $this->moduleDirView = AppServiceProvider::$moduleNamespace . '::.' . APP_VIEWS_DIR;
        $this->moduleNamespace = AppServiceProvider::$moduleNamespace;
    }
}
