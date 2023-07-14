<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Core\Account\Infrastructure\IAccount;
use Core\Account\Infrastructure\Facades\Account;
use Core\Account\Infrastructure\IJWTAuth;
use Core\Account\Infrastructure\Facades\JWTAuth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function register()
    {
        $this->app->bind(IAccount::class, Account::class);
        $this->app->bind(IJWTAuth::class, JWTAuth::class);
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
