<?php

use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FrontEnd\PageController;
use App\Http\Controllers\Auth\ResetPasswordController;


//login page
Route::get('login', [PageController::class, 'login'])->name('login');

//register page
Route::get('register', [PageController::class, 'register'])->name('register');

//user registration
Route::post('/user-registration', [AuthController::class, 'userRegistration'])->name('user-registration');

//user login
Route::post('/user-login', [AuthController::class, 'userLogin'])->name('user-login');

//user logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//verify email
Route::get('/verify-email-page', [ResetPasswordController::class, 'verifyEmailPage'])->name('verify-email');

//verify email
Route::post('/verify-email', [ResetPasswordController::class, 'verifyEmail'])->name('verify-email');

//verify opt page
Route::get('/verify-otp-page', [ResetPasswordController::class, 'verifyOtpPage'])->name('verify-otp-page');

//verify otp
Route::post('/verify-otp', [ResetPasswordController::class, 'verifyOtp'])->name('verify-otp');

//reset password page
Route::get('/reset-password-page', [ResetPasswordController::class, 'resetPasswordPage'])->name('reset-password-page')
->middleware(TokenVerificationMiddleware::class);

//reset password
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('reset-password')
->middleware(TokenVerificationMiddleware::class);
