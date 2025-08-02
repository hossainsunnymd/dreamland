<?php

use App\Http\Controllers\BackEnd\ReviewController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {

    Route::get('/reviews', [ReviewController::class, 'reviewList'])
        ->name('review-list')->middleware('permission:review-list');
    Route::get('/review-save-page', [ReviewController::class, 'reviewSavePage'])
        ->name('review-save-page')->middleware('permission:review-save-page');
    Route::post('/review', [ReviewController::class, 'reviewSave'])
        ->name('review-save')->middleware('permission:review-save');
    Route::post('/review/{id}', [ReviewController::class, 'reviewUpdate'])
        ->name('review-Update')->middleware('permission:review-update');
    Route::get('/review/{id}', [ReviewController::class, 'reviewDelete'])
        ->name('review-delete')->middleware('permission:review-delete');
});
