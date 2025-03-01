<?php

namespace App\Providers;

use App\Services\StreamPlatformService;
use Illuminate\Support\ServiceProvider;

class StreamPlatformServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(StreamPlatformService::class, function ($app) {
            return new StreamPlatformService();
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
