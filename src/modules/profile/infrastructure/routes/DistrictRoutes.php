<?php

namespace Src\modules\profile\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\profile\infrastructure\controllers\DistrictController;

Route::post("/create", [DistrictController::class, "createDistrict"]);
Route::get("/get-all", [DistrictController::class, "getAllDistrict"]);
Route::get("/{id}", [DistrictController::class, "getOneByIdDistrict"]);
Route::put("/update", [DistrictController::class, "updateDistrict"]);
Route::delete("/{id}", [DistrictController::class, "deleteDistrict"]);