<?php


namespace Page\Http\Controllers\App;


use App\Http\Controllers\Controller;
use Page\Providers\AppServiceProvider;

class CoreController extends Controller
{

    protected $model;
    protected $moduleDirView;
    protected $moduleNamespace;
    protected $moduleRoute;

    public function __construct()
    {
        $this->moduleDirView = AppServiceProvider::$moduleNamespace . '::.' . APP_VIEWS_DIR;
    }
}
