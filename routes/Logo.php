<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackEnd\LogoController;




Route::prefix('admin')->group(function () {

    Route::get('/logos', [LogoController::class, 'logoList'])
        ->name('logo-list')->middleware('permission:logo-list');
    Route::get('/logo-save-page', [LogoController::class, 'logoSavePage'])
        ->name('logo-save-page')->middleware('permission:logo-save-page');
    Route::post('/logo', [LogoController::class, 'logoSave'])
        ->name('logo')->middleware('permission:logo-save');
    Route::post('/logo/{id}', [LogoController::class, 'logoUpdate'])
        ->name('logo')->middleware('permission:logo-update');
    Route::get('/logo/{id}', [LogoController::class, 'logoDelete'])
        ->name('logo-delete')->middleware('permission:logo-delete');
});
