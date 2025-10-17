<?php
namespace Src\modules\security\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\security\infrastructure\controllers\PermissionsController;

Route::prefix("permissions")->group(function () {
    Route::post("/", [PermissionsController::class, "createPermissions"]);
    Route::get("/", [PermissionsController::class, "getAllPermissions"]);
    Route::get("/list", [PermissionsController::class, 'getAllPermissionsWithCategories']);
    Route::get("/{id}", [PermissionsController::class, "getOneByIdPermissions"]);
    Route::put("{id}", [PermissionsController::class, "updatePermissions"]);
    
});