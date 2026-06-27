<?php


namespace App\Http\Middleware;

use App\Traits\Response;
use Closure;
use Illuminate\Support\Facades\Auth;


class RedirectIfUnAuthenticated
{
    use Response;

    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard()->check() && $request->segment(2) == ADMIN_PREFIX) {
            return redirect(route('auth.admin.login'));
        }

        if (!Auth::guard()->check()) {
            $message = trans('messages.is_login');

            if ($request->expectsJson()) {
                return $this->response(
                    ['redirectTo' => redirectToBack($message, true)],
                    null,
                    $message,
                    Response::$UNAUTHORIZED
                );
            }

            return redirectToBack($message);
        }
        return $next($request);
    }
}
