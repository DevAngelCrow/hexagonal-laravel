<?php

namespace Src\modules\profile\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\profile\infrastructure\controllers\PeopleController;

Route::post("/create", [PeopleController::class, "createPeople"]);
Route::get("/{id}", [PeopleController::class, "getOneByIdPeople"]);
Route::get("/email/{email}", [PeopleController::class, "getOneByEmail"]);
Route::put("/update", [PeopleController::class, "updatePeople"]);