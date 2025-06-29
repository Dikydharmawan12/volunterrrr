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
    public function boot()
    {
        $sqlitePath = database_path('database.sqlite');
        if (!file_exists($sqlitePath)) {
            file_put_contents($sqlitePath, '');
        }
    }    
}