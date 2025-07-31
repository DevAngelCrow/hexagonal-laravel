<?php

namespace Src\modules\profile\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\profile\infrastructure\controllers\DepartmentController;

Route::post("/create", [DepartmentController::class, "createDepartment"]);
Route::get("/get-all", [DepartmentController::class, "getAllDepartment"]);
Route::get("/{id}", [DepartmentController::class, "getOneByIdDepartment"]);
Route::put("/update", [DepartmentController::class, "updateDepartment"]);
Route::delete("/{id}", [DepartmentController::class, "deleteDepartment"]);