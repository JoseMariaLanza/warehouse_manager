<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Core\Shifts\Infrastructure\Facades\Shift;
use Core\Shifts\Infrastructure\IShift;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IShift::class, Shift::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
