<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\modules\auth\domain\repositories\user\UserRepositoryInterface;
use Src\modules\auth\infrastructure\implementation\UserRepositoryImplementation\ImplUserRepository;
use Src\modules\profile\domain\repositories\address\AddressRepositoryInterface;
use Src\modules\profile\domain\repositories\country\CountryRepositoryInterface;
use Src\modules\profile\domain\repositories\department\DepartmentRepositoryInterface;
use Src\modules\profile\domain\repositories\district\DistrictRepositoryInterface;
use Src\modules\profile\domain\repositories\documents\DocumentRepositoryInterface;
use Src\modules\profile\domain\repositories\municipality\MunicipalityRepositoryInterface;
use Src\modules\profile\domain\repositories\people\PeopleRepositoryInterface;
use Src\modules\profile\infrastructure\implementation\AddressRepositoryImplementation\ImplAddressRepository;
use Src\modules\profile\infrastructure\implementation\CountryRepositoryImplementation\ImplCountryRepository;
use Src\modules\profile\infrastructure\implementation\DepartmentRepositoryImplementation\ImplDepartmentRepository;
use Src\modules\profile\infrastructure\implementation\DistrictRepositoryImplementation\ImplDistrictRepository;
use Src\modules\profile\infrastructure\implementation\DocumentRepositoryImplementation\ImplDocumentRepository;
use Src\modules\profile\infrastructure\implementation\MunicipalityRepositoryImplementation\ImplMunicipalityRepository;
use Src\modules\profile\infrastructure\implementation\PeopleRepositoryImplementation\ImplPeopleRepository;
use Src\shared\domain\repositories\UnitOfWorkTransactionDbInterface;
use Src\shared\infrastructure\implementations\EloquentUnitOfWork;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(AddressRepositoryInterface::class, ImplAddressRepository::class);
        $this->app->bind(PeopleRepositoryInterface::class, ImplPeopleRepository::class);
        $this->app->bind(UserRepositoryInterface::class, ImplUserRepository::class);
        $this->app->bind(UnitOfWorkTransactionDbInterface::class, EloquentUnitOfWork::class);
        $this->app->bind(DocumentRepositoryInterface::class, ImplDocumentRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, ImplCountryRepository::class);
        $this->app->bind(DepartmentRepositoryInterface::class, ImplDepartmentRepository::class);
        $this->app->bind(MunicipalityRepositoryInterface::class, ImplMunicipalityRepository::class);
        $this->app->bind(DistrictRepositoryInterface::class, ImplDistrictRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
