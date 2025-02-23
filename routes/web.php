<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RepairShopController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/api/user', function () {
    $user = Auth::user();
    return response()->json([$user], 200);
});

Route::get('/dashboard', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return response()->json([$user], 200);
    } else {
        return response()->json(['message' => 'Not authenticated'], 401); // Return 401 if not logged in
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/bookings', [BookingController::class, 'store']);
});



Route::resource('/repairshops', RepairShopController::class);

Route::get('/sanctum/csrf-cookie', function () {
    return response()->json(['message' => 'CSRF cookie set']);
});



require __DIR__ . '/auth.php';
