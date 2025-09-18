<?php
namespace Src\modules\catalogs\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\catalogs\infrastructure\controllers\GlobalStatusController;

Route::prefix("global_status")->group(function () {
    Route::post("", [GlobalStatusController::class, "createGlobalStatus"]);
    Route::get("", [GlobalStatusController::class, "getAllGlobalStatus"]);
    Route::get("/{id}", [GlobalStatusController::class, "getOneByIdGlobalStatus"]);
    Route::put("/{id}", [GlobalStatusController::class, "updateGlobalStatus"]);
    Route::delete("/{id}", [GlobalStatusController::class, "deleteGlobalStatus"]);
});
