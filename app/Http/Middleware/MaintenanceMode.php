<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MaintenanceMode
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
        $maintenanceMode = getSetting('maintenance_mode');

        if ($maintenanceMode == 1)
            abort(503);

        return $next($request);
    }
}
