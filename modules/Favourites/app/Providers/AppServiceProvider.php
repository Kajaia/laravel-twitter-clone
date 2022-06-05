<?php

namespace Modules\Favourites\app\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Database
        Schema::defaultStringLength(191);
        
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }
}
