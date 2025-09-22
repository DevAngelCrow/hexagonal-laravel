<?php

namespace Src\modules\catalogs\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\catalogs\infrastructure\controllers\CountryController;

Route::prefix("countries")->group(function () {
    Route::post("/", [CountryController::class, "createCountry"]);
    Route::get("/", [CountryController::class, "getAllCountry"]);
    Route::get("/{id}", [CountryController::class, "getOneByIdCountry"]);
    Route::put("/{id}", [CountryController::class, "updateCountry"]);
    Route::delete("/{id}", [CountryController::class, "deleteCountry"]);
});
