<?php

namespace Modules\Followers\app\Providers;

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
    }

}