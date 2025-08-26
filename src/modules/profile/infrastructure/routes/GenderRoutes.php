<?php

namespace Src\modules\profile\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\profile\infrastructure\controllers\GenderController;

Route::prefix("genders")->group(function() {
    Route::post("", [GenderController::class, "createGender"]);
    Route::get("", [GenderController::class, "getAllGender"]);
    Route::get("/{id}", [GenderController::class, "getGenderById"]);
    Route::put("/{id}", [GenderController::class, "updateGender"]);
});