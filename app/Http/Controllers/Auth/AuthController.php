<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;

class AuthController extends Controller
{

    public function authenticate(Request $request)
    {
        if ($request->hasSession()) {
            $request->session()->reflash();
        }
        return Broadcast::auth($request);
    }

    protected function redirectTo()
    {
        return route_app('account.dashboard.index');
    }


}
