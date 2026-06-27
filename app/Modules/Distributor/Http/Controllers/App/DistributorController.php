<?php


namespace Distributor\Http\Controllers\App;


use Distributor\Models\Distributor;
use Illuminate\Http\Request;
use Product\Providers\AppServiceProvider;

class DistributorController extends CoreController
{
    public function __construct()
    {
        $this->moduleDirView = AppServiceProvider::$moduleNamespace . '::' . APP_VIEWS_DIR;
        $this->moduleNamespace = AppServiceProvider::$moduleNamespace;
        parent::__construct();
    }

    public function index()
    {
        $pageTitle = trans_module_distributor('app.distributors');
        meta_data(trans_module_distributor('app.home'), $pageTitle, [
            '#' => trans_module_distributor('app.company'),
            '' => $pageTitle
        ]);
        $distributors = Distributor::getDistributors()->where('show_map',YES);
        $breadcrumb = getSetting('breadcrumb_ig_world');
        return view($this->moduleDirView . '.index', compact(
                'pageTitle','distributors','breadcrumb')
        );
    }

    public function details(Request $request)
    {
        $pageTitle = trans_module_distributor('app.distributors');
        meta_data(trans_module_distributor('app.home'), $pageTitle, [
            '#' => trans_module_distributor('app.company'),
            '' => $pageTitle
        ]);
        $distributors = Distributor::getDistributors()->where('show_map',YES)->where('country_id',$request->country);
        return view($this->moduleDirView . '.details', compact(
                'pageTitle','distributors')
        );
    }
}
