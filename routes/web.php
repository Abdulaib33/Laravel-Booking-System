<?php

use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'role:admin,editor'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('services', ServiceController::class);

            Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
            Route::patch('bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.status');
        });

Route::middleware('auth')->group(function () {
        Route::get('/book', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('/book', [BookingController::class, 'store'])->name('bookings.store');
});

require __DIR__.'/auth.php';
