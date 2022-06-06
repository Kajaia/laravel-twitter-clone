<?php

namespace Modules\Tweets\app\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(__DIR__.'/../../routes/web.php');
        });
    }

}