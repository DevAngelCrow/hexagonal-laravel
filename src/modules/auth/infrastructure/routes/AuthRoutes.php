<?php

namespace Src\modules\auth\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\auth\infrastructure\controllers\AuthController;

Route::post("sing-up", [AuthController::class, "singUp"]);
