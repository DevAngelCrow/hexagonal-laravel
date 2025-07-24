
<?php

use Illuminate\Support\Facades\Route;
use Src\modules\profile\infrastructure\controllers\AddressController;

Route::post("/create", [AddressController::class, "createAddress"]);