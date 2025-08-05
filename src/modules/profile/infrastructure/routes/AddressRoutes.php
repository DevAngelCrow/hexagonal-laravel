<?php

namespace Src\modules\profile\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\profile\infrastructure\controllers\AddressController;

Route::prefix("addresses")->group(function () {
    Route::post("", [AddressController::class, "createAddress"]);
    Route::get("", [AddressController::class, "getAllAddress"]);
    Route::get("/{id}", [AddressController::class, "getOneByIdAddress"]);
    Route::put("/{id}", [AddressController::class, "updateAddress"]);
});
