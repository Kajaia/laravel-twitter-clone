<?php

namespace Modules\Tweets\app\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        // 
    }

    public function boot()
    {
        Schema::defaultStringLength(191);

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'tweet');

        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

}