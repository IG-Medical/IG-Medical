<?php


namespace App\Http\Middleware;

use App\Traits\Response;
use Closure;
use Illuminate\Support\Facades\Auth;
use User\Models\Role;


class IsAdminAuthenticated
{
    use Response;

    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard()->check()) {
            return redirect(route('auth.admin.login'));
        } else {
            if (Auth::user()->role_id !== Role::ADMINISTRATION) {
                return redirect()->to(route_app('home.index'));
            }
        }

        return $next($request);
    }
}
