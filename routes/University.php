<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackEnd\UniversityController;



Route::prefix('admin')->group(function (){

    Route::get('/universities', [UniversityController::class, 'universityList'])
        ->name('university-list')->middleware('permission:university-list');
    Route::get('/university-save-page', [UniversityController::class, 'universitySavePage'])
        ->name('university-save-page')->middleware('permission:university-save-page');
    Route::post('/university', [UniversityController::class, 'universitySave'])
        ->name('university-save')->middleware('permission:university-save');
    Route::post('/university/{id}', [UniversityController::class, 'universityUpdate'])
        ->name('university-Update')->middleware('permission:university-update');
    Route::get('/university/{id}', [UniversityController::class, 'universityDelete'])
        ->name('university-delete')->middleware('permission:university-delete');
});
