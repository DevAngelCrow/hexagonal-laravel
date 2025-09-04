<?php

namespace Src\modules\catalogs\marital\infrastructure\routes;


use Illuminate\Support\Facades\Route;
use Src\modules\catalogs\marital\infrastructure\api\controllers\MaritalStatusController;

Route::controller(MaritalStatusController::class)->prefix("marital-status")->group(function () {
    Route::post("/", "store");
    Route::get("/", "index");
});
