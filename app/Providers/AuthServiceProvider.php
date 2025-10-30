<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
         //$this->registerPolicies();

        Passport::tokensExpireIn(now()->addDays(1)); 
        Passport::refreshTokensExpireIn(now()->addDays(1)); 
        Passport::personalAccessTokensExpireIn(now()->addDays(1));
    }
}
