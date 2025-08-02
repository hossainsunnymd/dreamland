<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackEnd\CountryController;
use App\Http\Middleware\TokenVerificationMiddleware;
use App\Http\Controllers\BackEnd\CountryDetailController;

//countries
Route::prefix('admin')->group(function () {
    Route::get('/countries', [CountryController::class, 'countryList'])
        ->name('country-list')->middleware('permission:country-list');
    Route::get('/country-save-page', [CountryController::class, 'countrySavePage'])
        ->name('country-save-page')->middleware('permission:country-save-page');
    Route::post('/country', [CountryController::class, 'countrySave'])
        ->name('country-save')->middleware('permission:country-save');
    Route::post('/country/{id}', [CountryController::class, 'countryUpdate'])
        ->name('country-Update')->middleware('permission:country-update');
    Route::get('/country/{id}', [CountryController::class, 'countryDelete'])
        ->name('country-delete')->middleware('permission:country-delete');
});


//country details
Route::prefix('admin')->group(function () {

    Route::get('country-details', [CountryDetailController::class, 'countryDetailList'])
    ->name('country-detail-list')->middleware('permission:country-detail-list');
    Route::get('country-detail-save-page', [CountryDetailController::class, 'countryDetailSavePage'])
    ->name('country-detail-save-page')->middleware('permission:country-detail-save-page');
    Route::post('country-detail', [CountryDetailController::class, 'countryDetailSave'])
    ->name('country-detail-save')->middleware('permission:country-detail-save');
    Route::post('country-detail/{id}', [CountryDetailController::class, 'countryDetailUpdate'])
    ->name('country-detail-update')->middleware('permission:country-detail-update');
    Route::get('country-detail/{id}', [CountryDetailController::class, 'countryDetailDelete'])
    ->name('country-detail-delete')->middleware('permission:country-detail-delete');
});
