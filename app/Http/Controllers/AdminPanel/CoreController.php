<?php

namespace App\Http\Controllers\AdminPanel;


use App\Http\Controllers\Controller;
use App\Traits\Response;


class CoreController extends Controller
{
    use Response;

    protected $model;
    protected $viewPath;
    protected $asRoute;
    protected $route;
}
