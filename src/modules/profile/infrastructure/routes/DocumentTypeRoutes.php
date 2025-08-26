<?php

namespace Src\modules\profile\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\profile\infrastructure\controllers\DocumentTypeController;

Route::prefix("documentType")->group(function () {
    Route::post("/", [DocumentTypeController::class, "createDocumentType"]);
    Route::get("/", [DocumentTypeController::class, "getAllDocumentType"]);
    Route::get("/{id}", [DocumentTypeController::class, "getOneByIdDocumentType"]);
    Route::put("/{id}", [DocumentTypeController::class, "updateDocumentType"]);
    Route::delete("/{id}", [DocumentTypeController::class, "deleteDocumentType"]);
});
