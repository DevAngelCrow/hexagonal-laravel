<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix("profile")->group(function () {
    require base_path("src/modules/profile/infrastructure/routes/AddressRoutes.php");
    require base_path("src/modules/profile/infrastructure/routes/PeopleRoutes.php");
    require base_path("src/modules/profile/infrastructure/routes/DocumentRoutes.php");
    require base_path("src/modules/profile/infrastructure/routes/CountryRoutes.php");
    require base_path("src/modules/profile/infrastructure/routes/DepartmentRoutes.php");
    require base_path("src/modules/profile/infrastructure/routes/MunicipalityRoutes.php");
    require base_path("src/modules/profile/infrastructure/routes/DistrictRoutes.php");
});
Route::prefix("user")->group(base_path("src/modules/auth/infrastructure/routes/UserRoutes.php"));
Route::prefix("auth")->group(base_path("src/modules/auth/infrastructure/routes/AuthRoutes.php"));
