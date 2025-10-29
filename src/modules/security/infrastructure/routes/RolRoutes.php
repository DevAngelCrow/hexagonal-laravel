<?php

namespace Src\modules\security\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\security\infrastructure\controllers\RolController;

Route::prefix("roles")->group(function () {
    Route::post("/", [RolController::class, "createRol"]);
    Route::get("/", [RolController::class, "getAllRol"]);
    Route::get("list", [RolController::class, "getAllRolWithStatus"]);
    Route::get("/{id}", [RolController::class, "getOneByIdRol"]);
    Route::put("{id}", [RolController::class, "updateRol"]);
});
