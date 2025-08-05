<?php

namespace Src\modules\profile\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\profile\infrastructure\controllers\DistrictController;

Route::prefix("districts")->group(function () {
    Route::post("/", [DistrictController::class, "createDistrict"]);
    Route::get("/", [DistrictController::class, "getAllDistrict"]);
    Route::get("/{id}", [DistrictController::class, "getOneByIdDistrict"]);
    Route::put("/{id}", [DistrictController::class, "updateDistrict"]);
    Route::delete("/{id}", [DistrictController::class, "deleteDistrict"]);
});
