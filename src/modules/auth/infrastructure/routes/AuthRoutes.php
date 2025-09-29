<?php

namespace Src\modules\auth\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\auth\infrastructure\controllers\AuthController;


Route::post("login", [AuthController::class, "login"]);
Route::post("logout", [AuthController::class, "logout"])->middleware(["auth:api"]);
Route::post("sign-up", [AuthController::class, "signUp"]);

//esta ruta es para volver a solicitar el link de verificación de correo electrónico.
Route::post("/email/verification-notification", [AuthController::class, "verifyEmail"]);

//esta ruta es para verificar el correo electrónico
Route::get("/email/verify/{id}/{hash}", [AuthController::class, "receptionToValidate"])->middleware(["signed"])
    ->name("verification.verify");
