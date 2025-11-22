<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;

Route::prefix('cars')->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('cars.index');
    Route::get('{id}', [CarController::class, 'show'])->name('cars.show');
    Route::post('/', [CarController::class, 'store'])->name('cars.store');
    Route::delete('{id}', [CarController::class, 'destroy'])->name('cars.destroy');
});


Route::prefix('bookings')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::post('/', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});
