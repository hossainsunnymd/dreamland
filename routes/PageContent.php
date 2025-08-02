<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackEnd\PageContentController;


Route::prefix('admin')->group(function () {
    Route::get('/page-contents', [PageContentController::class, 'pageContentList'])
        ->name('page-content-list')->middleware('permission:page-content-list');
    Route::get('/page-content-save-page', [PageContentController::class, 'pageContentSavePage'])
        ->name('page-content-save-page')->middleware('permission:page-content-save-page');
    Route::post('/page-content', [PageContentController::class, 'pageContentSave'])
        ->name('page-content-save')->middleware('permission:page-content-save');
    Route::post('/page-content/{id}', [PageContentController::class, 'pageContentUpdate'])
        ->name('page-content-Update')->middleware('permission:page-content-update');
    Route::get('/page-content/{id}', [PageContentController::class, 'pageContentDelete'])
        ->name('page-content-delete')->middleware('permission:page-content-delete');
});



