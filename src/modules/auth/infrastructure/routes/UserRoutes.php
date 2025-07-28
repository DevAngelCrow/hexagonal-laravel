<?php

namespace Src\modules\auth\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\auth\infrastructure\controllers\UserController;

Route::post("create", [UserController::class, "createUser"]);
