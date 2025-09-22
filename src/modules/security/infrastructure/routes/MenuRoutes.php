<?php
namespace Src\modules\security\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\security\infrastructure\controllers\MenuController;

Route::prefix("menu")->group(function () {
    Route::post("/", [MenuController::class, "getMenuUser"]);
});