<?php

namespace App\Providers;

use App\Services\WatchlistService;
use Illuminate\Support\ServiceProvider;

class WatchlistServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(WatchlistService::class, function ($app) {
            return new WatchlistService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
