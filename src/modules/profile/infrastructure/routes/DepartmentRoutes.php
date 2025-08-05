<?php

namespace Src\modules\profile\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\profile\infrastructure\controllers\DepartmentController;

Route::prefix("departments")->group(function () {
    Route::post("/", [DepartmentController::class, "createDepartment"]);
    Route::get("/", [DepartmentController::class, "getAllDepartment"]);
    Route::get("/{id}", [DepartmentController::class, "getOneByIdDepartment"]);
    Route::put("/{id}", [DepartmentController::class, "updateDepartment"]);
    Route::delete("/{id}", [DepartmentController::class, "deleteDepartment"]);
});
