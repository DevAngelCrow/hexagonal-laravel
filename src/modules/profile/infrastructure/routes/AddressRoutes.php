<?php

namespace Src\modules\profile\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\profile\infrastructure\controllers\AddressController;

Route::post("/create", [AddressController::class, "createAddress"]);
Route::get("/get-all", [AddressController::class, "getAllAddress"]);
Route::get("/{id}", [AddressController::class, "getOneByIdAddress"]);
Route::put("/update", [AddressController::class, "updateAddress"]);