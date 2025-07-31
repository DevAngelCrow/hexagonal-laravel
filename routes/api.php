<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix("address")->group(base_path("Src/modules/profile/infrastructure/routes/AddressRoutes.php"));
Route::prefix("person")->group(base_path("Src/modules/profile/infrastructure/routes/PeopleRoutes.php"));
Route::prefix("document")->group(base_path("Src/modules/profile/infrastructure/routes/DocumentRoutes.php"));
Route::prefix("country")->group(base_path("Src/modules/profile/infrastructure/routes/CountryRoutes.php"));
Route::prefix("department")->group(base_path("Src/modules/profile/infrastructure/routes/DepartmentRoutes.php"));
Route::prefix("municipality")->group(base_path("Src/modules/profile/infrastructure/routes/MunicipalityRoutes.php"));
Route::prefix("district")->group(base_path("Src/modules/profile/infrastructure/routes/DistrictRoutes.php"));
Route::prefix("user")->group(base_path("Src/modules/auth/infrastructure/routes/UserRoutes.php"));
Route::prefix("auth")->group(base_path("Src/modules/auth/infrastructure/routes/AuthRoutes.php"));

