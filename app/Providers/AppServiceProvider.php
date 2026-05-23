<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

         view()->share('actual_url', asset('../dist/'));
        view()->share('file_url', asset('../dist/'));

          config(['app.actual_url' => asset('../dist/')]);
        config(['app.file_url' => asset('../dist/')]);
    }
}
