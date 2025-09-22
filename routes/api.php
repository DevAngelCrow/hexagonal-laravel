<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix("profile")->middleware(["auth:api"])->group(function () {
    require base_path("src/modules/profile/infrastructure/routes/AddressRoutes.php");
    require base_path("src/modules/profile/infrastructure/routes/PeopleRoutes.php");
    require base_path("src/modules/profile/infrastructure/routes/DocumentRoutes.php");
    require base_path("src/modules/profile/infrastructure/routes/DocumentTypeRoutes.php");
});
Route::prefix("user")->middleware(["auth:api"])->group(base_path("src/modules/auth/infrastructure/routes/UserRoutes.php"));
Route::prefix("auth")->group(base_path("src/modules/auth/infrastructure/routes/AuthRoutes.php"));


Route::prefix('catalogs')->middleware(["auth:api"])->group(function () {
    require base_path("src/modules/catalogs/infrastructure/routes/MaritalRoutes.php");
    require base_path("src/modules/catalogs/infrastructure/routes/GlobalStatusRoutes.php");
    require base_path("src/modules/catalogs/infrastructure/routes/CountryRoutes.php");
    require base_path("src/modules/catalogs/infrastructure/routes/DepartmentRoutes.php");
    require base_path("src/modules/catalogs/infrastructure/routes/MunicipalityRoutes.php");
    require base_path("src/modules/catalogs/infrastructure/routes/DistrictRoutes.php");
    require base_path("src/modules/catalogs/infrastructure/routes/GenderRoutes.php");
});

Route::prefix("security")->middleware(["auth:api"])->group(function () {
    require base_path("src/modules/security/infrastructure/routes/CategoryPermissionsRoutes.php");
    require base_path("src/modules/security/infrastructure/routes/PermissionsRoutes.php");
    require base_path("src/modules/security/infrastructure/routes/RolRoutes.php");
    require base_path("src/modules/security/infrastructure/routes/RouteRoutes.php");
    require base_path("src/modules/security/infrastructure/routes/UserRolRoutes.php");
    require base_path("src/modules/security/infrastructure/routes/MenuRoutes.php");
});

Route::prefix("storage")->middleware(["auth:api"])->group(function (){
    require base_path("src/modules/storage/infrastructure/routes/ProviderStorageRoutes.php");
    require base_path("src/modules/storage/infrastructure/routes/StorageFilesRoutes.php");
});
