<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;
use Src\modules\auth\domain\ports\CredentialValidatorPortInterface;
use Src\modules\auth\domain\ports\HasVerifiedEmailPortInterface;
use Src\modules\auth\domain\ports\TokenGeneratorPortInterface;
use Src\modules\auth\domain\repositories\user\UserRepositoryInterface;
use Src\modules\auth\infrastructure\implementation\AuthPortImplementation\ImplCredentialValidatorPortInterface;
use Src\modules\auth\infrastructure\implementation\AuthPortImplementation\ImplHasVerifiedEmailPortInterface;
use Src\modules\auth\infrastructure\implementation\AuthPortImplementation\ImplTokenGeneratorPortInterface;
use Src\modules\auth\infrastructure\implementation\UserRepositoryImplementation\ImplUserRepository;
use Src\modules\catalogs\marital\domain\repositories\IMaritalStatusRepository;
use Src\modules\catalogs\marital\infrastructure\repositories\MaritalStatusRepositoryImpl;
use Src\modules\profile\domain\repositories\address\AddressRepositoryInterface;
use Src\modules\profile\domain\repositories\country\CountryRepositoryInterface;
use Src\modules\profile\domain\repositories\department\DepartmentRepositoryInterface;
use Src\modules\profile\domain\repositories\district\DistrictRepositoryInterface;
use Src\modules\profile\domain\repositories\documents\DocumentRepositoryInterface;
use Src\modules\profile\domain\repositories\gender\GenderRepositoryInterface;
use Src\modules\profile\domain\repositories\municipality\MunicipalityRepositoryInterface;
use Src\modules\profile\domain\repositories\people\PeopleRepositoryInterface;
use Src\modules\profile\domain\repositories\documentType\DocumentTypeRepositoryInterface;
use Src\modules\catalogs\global_status\domain\repositories\GlobalStatusRepositoryInterface;

use Src\modules\profile\infrastructure\implementation\GenderRepositoryImplementation\ImplGenderRepository;
use Src\modules\profile\infrastructure\implementation\AddressRepositoryImplementation\ImplAddressRepository;
use Src\modules\profile\infrastructure\implementation\CountryRepositoryImplementation\ImplCountryRepository;
use Src\modules\profile\infrastructure\implementation\DepartmentRepositoryImplementation\ImplDepartmentRepository;
use Src\modules\profile\infrastructure\implementation\DistrictRepositoryImplementation\ImplDistrictRepository;
use Src\modules\profile\infrastructure\implementation\DocumentRepositoryImplementation\ImplDocumentRepository;
use Src\modules\profile\infrastructure\implementation\MunicipalityRepositoryImplementation\ImplMunicipalityRepository;
use Src\modules\profile\infrastructure\implementation\PeopleRepositoryImplementation\ImplPeopleRepository;
use Src\modules\profile\infrastructure\implementation\DocumentTypeRepositoryImplementation\ImplDocumentTypeRepository;
use Src\modules\catalogs\global_status\infraestructure\implementation\ImplGlobalStatusRepository;
use Src\modules\security\domain\entities\category_permissions\CategoryPermissions;
use Src\modules\security\domain\entities\user_role\UserRole;
use Src\modules\security\domain\repositories\category_permissions\CategoryPermissionsRepositoryInterface;
use Src\modules\security\domain\repositories\permissions\PermissionsRepositoryInterface;
use Src\modules\security\domain\repositories\rol\RolRepositoryInterface;
use Src\modules\security\domain\repositories\route\RouteRepositoryInterface;
use Src\modules\security\domain\repositories\user_role\UserRoleRepositoryInterface;
use Src\modules\security\infrastructure\implementation\CategoryPermissionsImplementation\ImplCategoryPermissionsRepository;
use Src\modules\security\infrastructure\implementation\PermissionsImplementation\ImplPermissionsRepository;
use Src\modules\security\infrastructure\implementation\RolImplementation\ImplRolRepository;
use Src\modules\security\infrastructure\implementation\RouteImplementation\ImplRouteRepository;
use Src\modules\security\infrastructure\implementation\UserRoleImplementation\ImplUserRoleRepository;
use Src\modules\storage\domain\repositories\providerStorage\ProviderStorageRepositoryInterface;
use Src\modules\storage\domain\repositories\storageFiles\StorageFilesRepositoryInterface;
use Src\modules\storage\infrastructure\implementation\ProviderStorageRepositoryImplementation\ImplProviderStoreRepository;
use Src\modules\storage\infrastructure\implementation\StorageFilesRepositoryImplementation\ImplStorageFilesRepository;
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
        $this->app->bind(DocumentTypeRepositoryInterface::class, ImplDocumentTypeRepository::class);
        $this->app->bind(CategoryPermissionsRepositoryInterface::class, ImplCategoryPermissionsRepository::class);
        $this->app->bind(PermissionsRepositoryInterface::class, ImplPermissionsRepository::class);
        $this->app->bind(RolRepositoryInterface::class, ImplRolRepository::class);
        $this->app->bind(RouteRepositoryInterface::class, ImplRouteRepository::class);
        $this->app->bind(GenderRepositoryInterface::class, ImplGenderRepository::class);
        $this->app->bind(CategoryPermissionsRepositoryInterface::class, ImplCategoryPermissionsRepository::class);
        $this->app->bind(PermissionsRepositoryInterface::class, ImplPermissionsRepository::class);
        $this->app->bind(RolRepositoryInterface::class, ImplRolRepository::class);
        $this->app->bind(RouteRepositoryInterface::class, ImplRouteRepository::class);
        $this->app->bind(ProviderStorageRepositoryInterface::class, ImplProviderStoreRepository::class);
        $this->app->bind(StorageFilesRepositoryInterface::class, ImplStorageFilesRepository::class);
        $this->app->bind(UserRoleRepositoryInterface::class, ImplUserRoleRepository::class);
        $this->app->bind(GlobalStatusRepositoryInterface::class, ImplGlobalStatusRepository::class);
        $this->app->bind(CredentialValidatorPortInterface::class, ImplCredentialValidatorPortInterface::class);
        $this->app->bind(HasVerifiedEmailPortInterface::class, ImplHasVerifiedEmailPortInterface::class);
        $this->app->bind(TokenGeneratorPortInterface::class, ImplTokenGeneratorPortInterface::class);

        /*--------------------------------------------------
         |  CATALOGOS
         -----------------------------------------------------
        */

        // [MARITAL STATUS (ESTADO CIVIL)]

        $this->app->bind(
            IMaritalStatusRepository::class,
            MaritalStatusRepositoryImpl::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        VerifyEmail::toMailUsing(function (object $notifiable, string $url){
            $frontendUrl = config('app.frontend_url').'?url='. urlencode($url);
            return (new MailMessage)
            ->subject('Verificar direccion de correo electronico')
            ->line('Por favor haz clic en el botón de abajo para verificar tu dirección de correo electrónico.')
            ->action('Verificar correo', $frontendUrl);
        });
    }
}
