<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        // Metode register
    }

    public function boot()
    {
        // Gunakan Bootstrap 5 untuk pagination
        Paginator::defaultView('vendor.pagination.bootstrap-5');
    }
}
