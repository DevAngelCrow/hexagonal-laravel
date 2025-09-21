<?php

namespace Src\modules\catalogs\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\catalogs\infrastructure\controllers\GenderController;

Route::prefix("genders")->group(function() {
    Route::post("", [GenderController::class, "createGender"]);
    Route::get("", [GenderController::class, "getAllGender"]);
    Route::get("/{id}", [GenderController::class, "getGenderById"]);
    Route::put("/{id}", [GenderController::class, "updateGender"]);
});