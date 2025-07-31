<?php

namespace Src\modules\profile\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\profile\infrastructure\controllers\CountryController;

Route::post("/create", [CountryController::class, "createCountry"]);
Route::get("/get-all", [CountryController::class, "getAllCountry"]);
Route::get("/{id}", [CountryController::class, "getOneByIdCountry"]);
Route::put("/update", [CountryController::class, "updateCountry"]);
Route::delete("/{id}", [CountryController::class, "deleteCountry"]);