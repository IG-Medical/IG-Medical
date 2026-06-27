<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use User\Models\UserType;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check() && user()->role_id == UserType::ADMIN) {
                return redirect(route_admin('dashboard.index'));
            }
            if (Auth::guard($guard)->check() && user()->user_type_id == UserType::NORMAL) {
                return redirect(url_lang());
            }
        }

        return $next($request);
    }
}
