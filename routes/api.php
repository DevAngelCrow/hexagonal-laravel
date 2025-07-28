<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Src\modules\auth\infrastructure\controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix("address")->group(base_path("Src/modules/profile/infrastructure/routes/AddressRoutes.php"));
Route::prefix("person")->group(base_path("Src/modules/profile/infrastructure/routes/PeopleRoutes.php"));
Route::prefix("user")->group(base_path("Src/modules/auth/infrastructure/routes/UserRoutes.php"));
Route::prefix("auth")->group(base_path("Src/modules/auth/infrastructure/routes/AuthRoutes.php"));
