<?php

namespace Src\modules\profile\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\profile\infrastructure\controllers\DocumentController;


Route::prefix("documents")->group(function () {
    Route::post("/", [DocumentController::class, "createDocument"]);
    Route::get("/", [DocumentController::class, "getAllDocuments"]);
    Route::get("/{id}", [DocumentController::class, "getOneByIdDocument"]);
    Route::put("/{id}", [DocumentController::class, "updateDocument"]);
    Route::delete("/{id}", [DocumentController::class, "deleteDocument"]);
});
