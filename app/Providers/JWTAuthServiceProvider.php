<?php

namespace App\Providers;

use Core\Account\Infrastructure\Facades\JWTAuth;
use Core\Account\Infrastructure\IJWTAuth;
use Illuminate\Support\ServiceProvider;

class JWTAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IJWTAuth::class, JWTAuth::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
