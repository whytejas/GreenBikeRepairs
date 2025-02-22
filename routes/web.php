<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RepairShopController;

Route::get('/', [RepairShopController::class, 'index']);

Route::resource('/repairshops', RepairShopController::class);

Route::get('/sanctum/csrf-cookie', function () {
    return response()->json(['message' => 'CSRF cookie set']);
});
