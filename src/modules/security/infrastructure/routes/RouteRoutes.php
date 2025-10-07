<?php
namespace Src\modules\security\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\security\infrastructure\controllers\RouteController;

Route::prefix("routes")->group(function () {
    Route::post("/", [RouteController::class, "createRoute"]);
    Route::get("/", [RouteController::class, "getAllRoutes"]);
    Route::get("/list", [RouteController::class, "getAllRoutesWithParent"]);
    Route::get("/{id}", [RouteController::class, "getOneByIdRoute"]);
    Route::put("{id}", [RouteController::class, "updateRoute"]);
    Route::delete("{id}", [RouteController::class, "deleteRoute"]);
});