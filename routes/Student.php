<?php

use App\Http\Controllers\BackEnd\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\TokenVerificationMiddleware;




Route::prefix('admin')->group(function () {

    Route::get('/students', [StudentController::class, 'studentList'])
        ->name('student-list')->middleware('permission:student-list');
    Route::get('/student-save-page', [StudentController::class, 'studentSavePage'])
        ->name('student-save-page')->middleware('permission:student-save-page');
    Route::post('/student', [StudentController::class, 'studentSave'])
        ->name('student-save')->middleware('permission:student-save');
    Route::post('/student/{id}', [StudentController::class, 'studentUpdate'])
        ->name('student-Update')->middleware('permission:student-update');
    Route::get('/student/{id}', [StudentController::class, 'studentDelete'])
        ->name('student-delete')->middleware('permission:student-delete');
});
