<?php

use Doctrine\Common\Lexer\Token;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BackEnd\RoleController;
use App\Http\Middleware\TokenVerificationMiddleware;

//roles
Route::prefix('admin')->group(function () {
    Route::get('/roles', [RoleController::class, 'listRole'])
        ->name('list-role')
        ->middleware('permission:list-role');

    Route::get('/role-save-page', [RoleController::class, 'roleSavePage'])
        ->name('role-save-page')
        ->middleware('permission:role-save-page');

    Route::post('/role', [RoleController::class, 'createRole'])
        ->name('create-role')
        ->middleware('permission:create-role');

    Route::post('/role/{id}', [RoleController::class, 'updateRole'])
        ->name('update-role')
        ->middleware('permission:update-role');

    Route::get('/role/{id}', [RoleController::class, 'deleteRole'])
        ->name('delete-role')
        ->middleware('permission:delete-role');
});
