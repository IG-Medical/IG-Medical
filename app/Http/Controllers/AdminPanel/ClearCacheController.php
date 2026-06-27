<?php

namespace App\Http\Controllers\AdminPanel;
use Illuminate\Support\Facades\Artisan;

class ClearCacheController extends CoreController
{
    public function clearAll()
    {
        // Clear application cache:
        Artisan::call('cache:clear');
        Artisan::call('route:cache');
        Artisan::call('view:clear');
        Artisan::call('config:cache');
        Artisan::call('clear-compiled');
        Artisan::call('optimize:clear');
        dd(true);
        return redirect()->back();
    }

    public function clearCache()
    {
        // Clear application cache:
        Artisan::call('cache:clear');
        return redirect()->back();
    }

    public function clearView()
    {
        // Clear view cache:
        $exitCode = Artisan::call('view:clear');
        return redirect()->back();
    }

    public function clearRoute()
    {
        //Clear route cache:
        $exitCode = Artisan::call('route:cache');
        return redirect()->back();
    }

    public function clearConfig()
    {
        //Clear config cache:
        $exitCode = Artisan::call('config:cache');
        return redirect()->back();
    }

    public function clearCompiled()
    {
        // Clear compiled classes and services application cache
        $exitCode = Artisan::call('clear-compiled');
        return redirect()->back();
    }
}
