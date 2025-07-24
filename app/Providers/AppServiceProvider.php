<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\modules\profile\domain\repositories\address\AddressRepositoryInterface;
use Src\modules\profile\infrastructure\implementation\AddressRepositoryImplementation\ImplAddressRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(AddressRepositoryInterface::class, ImplAddressRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
