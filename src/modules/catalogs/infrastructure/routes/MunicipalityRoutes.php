<?php

namespace Src\modules\catalogs\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\catalogs\infrastructure\controllers\MunicipalityController;

Route::prefix("municipalities")->group(function () {
    Route::post("/", [MunicipalityController::class, "createMunicipality"]);
    Route::get("/", [MunicipalityController::class, "getAllMunicipality"]);
    //para listar con relacion al departamento
    Route::get("/list", [MunicipalityController::class, "getAllMunicipalityWithDepartment"]);
    Route::get("/{id}", [MunicipalityController::class, "getOneByIdMunicipality"]);
    Route::put("/{id}", [MunicipalityController::class, "updateMunicipality"]);
    Route::delete("/{id}", [MunicipalityController::class, "deleteMunicipality"]);
});
