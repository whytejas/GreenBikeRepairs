<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RepairShopController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookingController;


/* Route::get('/{any}', function () {
    return  redirect('/user'); // This will serve React's index.html
})->where('any', '.*'); */

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/user', function () {
    $user = Auth::user();
    if ($user !== null) {
        return response()->json([$user], 200);
    }
    return response()->json(null, 404);
});

Route::get('/dashboard', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return response()->json([$user], 200);
    } else {
        return response()->json(['message' => 'Not authenticated'], 401); // Return 401 if not logged in
    }
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('/bookings', BookingController::class)->middleware('auth');
Route::middleware('auth')->delete('/bookings/today', [BookingController::class, 'destroy']);


Route::resource('/repairshops', RepairShopController::class);

Route::get('/sanctum/csrf-cookie', function () {
    return response()->json(['message' => 'CSRF cookie set']);
});



require __DIR__ . '/auth.php';
