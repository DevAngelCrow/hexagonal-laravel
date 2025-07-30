<?php
namespace Src\modules\profile\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\profile\infrastructure\controllers\DocumentController;

Route::post("/create", [DocumentController::class, "createDocument"]);
Route::get("/get-all", [DocumentController::class, "getAllDocuments"]);
Route::get("/{id}", [DocumentController::class, "getOneByIdDocument"]);
Route::put("/update", [DocumentController::class, "updateDocument"]);
Route::delete("/{id}", [DocumentController::class, "deleteDocument"]);
