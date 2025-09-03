<?php
namespace Src\modules\storage\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\storage\infrastructure\controllers\ProviderStorageController;

Route::prefix("provider-storage")->group(function(){
    Route::post("/", [ProviderStorageController::class, "createProviderStorage"]);
    Route::get("/{id}", [ProviderStorageController::class, "getOneByIdProviderStorage"]);
    Route::get("/", [ProviderStorageController::class, "getAllProviderStorage"]);
    Route::put("/{id}", [ProviderStorageController::class, "updateProviderStorage"]);
    Route::delete("/{id}", [ProviderStorageController::class, "deleteProviderStorage"]);
});