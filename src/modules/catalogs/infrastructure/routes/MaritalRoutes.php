<?php
namespace Src\modules\catalogs\infrastructure\routes;


use Illuminate\Support\Facades\Route;
use Src\modules\catalogs\infrastructure\controllers\MaritalStatusController;

Route::prefix("marital-status")->group(function () {
    Route::get("", [MaritalStatusController::class, "index"]);
    Route::post("", [MaritalStatusController::class, "store"]);
});
