<?php

namespace Src\modules\security\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\security\infrastructure\controllers\CategoryPermissionsController;

Route::prefix("category-permissions")->group(function () {
    Route::post("/", [CategoryPermissionsController::class, "createCategoryPermission"]);
    Route::get("/", [CategoryPermissionsController::class, "getAllCategoryPermissions"]);
    Route::get("/{id}", [CategoryPermissionsController::class, "getOneByIdCategoryPermissions"]);
    Route::put("{id}", [CategoryPermissionsController::class, "updateCategoryPermissions"]);
});
