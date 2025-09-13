<?php

namespace Src\modules\auth\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\auth\infrastructure\controllers\UserController;

Route::post("/", [UserController::class, "createUser"]);
Route::get("/{user_name}", [UserController::class, "getOneByUserName"]);
