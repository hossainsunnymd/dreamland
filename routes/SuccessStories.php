<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\TokenVerificationMiddleware;
use App\Http\Controllers\BackEnd\SuccessStoriesController;



Route::prefix('admin')->group(function () {

    Route::get('/success-stories', [SuccessStoriesController::class, 'successStoriesList'])
        ->name('success-stories-list')->middleware('permission:success-stories-list');
    Route::get('/success-stories-save-page', [SuccessStoriesController::class, 'successStoriesSavePage'])
        ->name('success-stories-save-page')->middleware('permission:success-stories-save-page');
    Route::post('/success-stories', [SuccessStoriesController::class, 'successStoriesSave'])
        ->name('success-stories-save')->middleware('permission:success-stories-save');
    Route::post('/success-stories/{id}', [SuccessStoriesController::class, 'successStoriesUpdate'])
        ->name('success-stories-Update')->middleware('permission:success-stories-update');
    Route::get('/success-stories/{id}', [SuccessStoriesController::class, 'successStoriesDelete'])
        ->name('success-stories-delete')->middleware('permission:success-stories-delete');
});
