<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackEnd\ServiceController;
use App\Http\Middleware\TokenVerificationMiddleware;
use App\Http\Controllers\BackEnd\ServiceCategoryController;


Route::prefix('admin')->group(function () {

    //service category
    Route::get('/service-categories', [ServiceCategoryController::class, 'ServiceCategoryList'])
        ->name('service-category-list')->middleware('permission:service-category-list');
    Route::get('/service-category-save-page', [ServiceCategoryController::class, 'serviceCategorySavePage'])
        ->name('service-category-save-page')->middleware('permission:service-category-save-page');
    Route::post('/save-service-category', [ServiceCategoryController::class, 'saveServiceCategory'])
        ->name('save-service-category')->middleware('permission:service-category-save-page');
    Route::post('/update-service-category/{id}', [ServiceCategoryController::class, 'updateServiceCategory'])
        ->name('update-service-category')->middleware('permission:service-category-save-page');
    Route::get('/delete-service-category/{id}', [ServiceCategoryController::class, 'deleteServiceCategory'])
        ->name('delete-service-category')->middleware('permission:service-category-delete');


    //service list

    Route::get('/services', [ServiceController::class, 'ServiceList'])
        ->name('service-list')->middleware('permission:service-list');
    Route::get('/service-save-page', [ServiceController::class, 'serviceSavePage'])->name('service-save-page')->middleware('permission:service-save-page');
    Route::post('/service', [ServiceController::class, 'saveService'])
        ->name('save-service')->middleware('permission:service-save-page');
    Route::post('/service/{id}', [ServiceController::class, 'updateService'])
        ->name('update-service')->middleware('permission:service-update');
    Route::get('/service/{id}', [ServiceController::class, 'deleteService'])
        ->name('delete-service')->middleware('permission:service-delete');


});



