<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix("address")->group(base_path("src/modules/profile/infrastructure/routes/AddressRoutes.php"));
