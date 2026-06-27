<?php


namespace App\Http\Controllers\AdminPanel;


class DashboardController extends CoreController
{
    public function __construct()
    {
     //   $this->middleware('permission:index-dashboard', ['only' => ['index']]);
    }

    public function index()
    {
        meta_data(trans('admin.dashboard'), trans('admin.dashboard'), [
            '#' => trans('admin.dashboard'),
        ]);

        return view('admin_panel.dashboard.index');
    }
}
