<?php

namespace App\Http\Controllers;

use App\Traits\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Product\Models\Product;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Response;

    public function productsRelated()
    {
        return Product::active()->inRandomOrder()->limit(12)->get();
    }
}
