<?php

namespace Src\modules\security\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\security\infrastructure\controllers\UserRoleController;

Route::prefix("user-roles")->group(function () {
    Route::post("/", [UserRoleController::class, "createUserRol"]);

    Route::put("/", [UserRoleController::class, "updateUserRol"]);
});