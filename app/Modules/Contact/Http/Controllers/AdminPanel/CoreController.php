<?php


namespace Contact\Http\Controllers\AdminPanel;


use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Contact\Providers\AppServiceProvider;

class CoreController extends Controller
{
    protected $model;
    protected $moduleDirView;
    protected $moduleNamespace;
    protected $moduleRoute;


    public function __construct(Model $model)
    {
        $this->moduleDirView = AppServiceProvider::$moduleNamespace . '::' . ADMIN_VIEWS_DIR ;
        $this->model = $model;
        $this->moduleNamespace = AppServiceProvider::$moduleNamespace;
        $this->moduleRoute = AppServiceProvider::$moduleNamePrefix;
    }
}

