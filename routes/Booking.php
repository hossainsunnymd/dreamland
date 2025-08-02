<?php

use App\Http\Controllers\BackEnd\BookingController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')->group(function () {
    Route::get('/bookings', [BookingController::class, 'bookingList'])
        ->name('booking-list')->middleware('permission:booking-list');
    Route::get('/booking-save-page', [BookingController::class, 'bookingSavePage'])
        ->name('booking-save-page')->middleware('permission:booking-save-page');
    Route::post('/booking', [BookingController::class, 'bookingSave'])
        ->name('booking-save')->middleware('permission:booking-save');
    Route::post('/booking/{id}', [BookingController::class, 'bookingUpdate'])
        ->name('booking-Update')->middleware('permission:booking-update');
    Route::get('/booking/{id}', [BookingController::class, 'bookingDelete'])
        ->name('booking-delete')->middleware('permission:booking-delete');
});

