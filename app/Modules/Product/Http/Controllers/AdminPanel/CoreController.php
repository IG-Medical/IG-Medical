<?php


namespace Product\Http\Controllers\AdminPanel;


use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

class CoreController extends Controller
{
    protected $model;
    protected $moduleDirView;
    protected $moduleNamespace;
    protected $moduleRoute;


    public function __construct(Model $model)
    {
        $this->model = $model;
//        $this->moduleNamespace = AppServiceProvider::$moduleNamespace;
//        $this->moduleRoute = AppServiceProvider::$moduleNamePrefix;
    }
}

