<?php

namespace Modules\Auth\app\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        // 
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'auth');

        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

}