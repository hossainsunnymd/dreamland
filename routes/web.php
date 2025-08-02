<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\FrontEnd\PageController;
use App\Http\Controllers\BackEnd\BookingController;
use App\Http\Controllers\FrontEnd\ProfileController;
use App\Http\Middleware\TokenVerificationMiddleware;

//home
Route::get('/', [PageController::class, 'home'])->name('home');

Route::middleware([TokenVerificationMiddleware::class])->group(function () {
    //student dashboard
    Route::prefix('/student')->group(function () {
        Route::get('/dashboard', [PageController::class, 'studentDashboard'])->name('student-dashboard');
    });
});


Route::middleware([TokenVerificationMiddleware::class])->prefix('student')->group(function () {
    //student booking
    Route::post('/booking', [BookingController::class, 'bookingSave'])->name('booking-save');
    //student profile update
    Route::post('/profile-update/{id}',[ProfileController::class,'updateProfile'])->name('profile-update');
});

require_once __DIR__ . '/Pages.php';
require_once __DIR__ . '/Auth.php';

Route::middleware([TokenVerificationMiddleware::class, AdminMiddleware::class])->group(function () {

    //dashboard
    Route::prefix('/admin')->group(function () {
        Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    });

    require_once __DIR__ . '/Booking.php';
    require_once __DIR__ . '/Country.php';
    require_once __DIR__ . '/SuccessStories.php';
    require_once __DIR__ . '/Review.php';
    require_once __DIR__ . '/Service.php';
    require_once __DIR__ . '/Roles.php';
    require_once __DIR__ . '/User.php';
    require_once __DIR__ . '/Student.php';
    require_once __DIR__ . '/PageContent.php';
    require_once __DIR__ . '/University.php';
});




