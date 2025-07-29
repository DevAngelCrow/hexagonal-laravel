<?php

namespace Src\modules\auth\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\auth\infrastructure\controllers\AuthController;

Route::post("login", [AuthController::class, "login"]);
Route::post("sing-up", [AuthController::class, "singUp"]);

Route::post("/email/verification-notification", [AuthController::class, "verifyEmail"]);
Route::get("/email/verify/{id}/{hash}", [AuthController::class, "receptionToValidate"])->middleware(["auth:api", "signed"])
    ->name("verification.verify");
