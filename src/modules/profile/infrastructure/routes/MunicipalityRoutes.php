<?php

namespace Src\modules\profile\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\profile\infrastructure\controllers\MunicipalityController;

Route::post("/create", [MunicipalityController::class, "createMunicipality"]);
Route::get("/get-all", [MunicipalityController::class, "getAllMunicipality"]);
Route::get("/{id}", [MunicipalityController::class, "getOneByIdMunicipality"]);
Route::put("/update", [MunicipalityController::class, "updateMunicipality"]);
Route::delete("/{id}", [MunicipalityController::class, "deleteMunicipality"]);