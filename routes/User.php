<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackEnd\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;




//users
Route::middleware(TokenVerificationMiddleware::class)->prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'listUser'])
    ->name('list-user')
    ->middleware('permission:list-user');

Route::get('/user-save-page', [UserController::class, 'userSavePage'])
    ->name('user-save-page')
    ->middleware('permission:user-save-page');

Route::post('/user', [UserController::class, 'createUser'])
    ->name('create-user')
    ->middleware('permission:create-user');

Route::post('/user/{id}', [UserController::class, 'updateUser'])
    ->name('update-user')
    ->middleware('permission:update-user');

Route::get('/user/{id}', [UserController::class, 'deleteUser'])
    ->name('delete-user')
    ->middleware('permission:delete-user');
});
