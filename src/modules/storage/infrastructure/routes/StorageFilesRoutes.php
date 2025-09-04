<?php
namespace Src\modules\storage\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\modules\storage\infrastructure\controllers\StorageFilesController;

Route::prefix("storage-files")->group(function() {
    Route::post("/", [StorageFilesController::class, "uploadFile"]);
});