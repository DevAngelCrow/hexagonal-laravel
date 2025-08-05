<?php

namespace Src\modules\profile\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\profile\infrastructure\controllers\MunicipalityController;


Route::prefix("municipalities")->group(function () {
    Route::post("/", [MunicipalityController::class, "createMunicipality"]);
    Route::get("/", [MunicipalityController::class, "getAllMunicipality"]);
    Route::get("/{id}", [MunicipalityController::class, "getOneByIdMunicipality"]);
    Route::put("/{id}", [MunicipalityController::class, "updateMunicipality"]);
    Route::delete("/{id}", [MunicipalityController::class, "deleteMunicipality"]);
});
