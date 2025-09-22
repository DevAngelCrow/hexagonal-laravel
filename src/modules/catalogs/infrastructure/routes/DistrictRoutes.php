<?php

namespace Src\modules\catalogs\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\catalogs\infrastructure\controllers\DistrictController;

Route::prefix("districts")->group(function () {
    Route::post("/", [DistrictController::class, "createDistrict"]);
    Route::get("/", [DistrictController::class, "getAllDistrict"]);
    //para listar con relacion a la ruta padre
    Route::get("/list", [DistrictController::class, "getAllDistrictWithMunicipality"]);
    Route::get("/{id}", [DistrictController::class, "getOneByIdDistrict"]);
    Route::put("/{id}", [DistrictController::class, "updateDistrict"]);
    Route::delete("/{id}", [DistrictController::class, "deleteDistrict"]);
});
