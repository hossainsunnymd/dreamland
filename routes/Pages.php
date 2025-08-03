<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEnd\PageController;
use App\Http\Controllers\FrontEnd\ServicePageController;
use App\Http\Middleware\TokenVerificationMiddleware;


Route::get('/profile', [PageController::class, 'profile'])->name('profile')->middleware(TokenVerificationMiddleware::class);
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/travel-booking', [PageController::class, 'travelBooking'])->name('travel-booking');
Route::get('/destination', [PageController::class, 'destination'])->name('destination');
Route::get('/our-gallery', [PageController::class, 'ourGallery'])->name('our-gallery');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/guides', [PageController::class, 'guides'])->name('guides');
Route::get('/packages', [PageController::class, 'packages'])->name('packages');
Route::get('/testimonial', [PageController::class, 'testimonial'])->name('testimonial');
Route::get('/explore-tour', [PageController::class, 'exploreTour'])->name('explore-tour');


//services

Route::get('/serviceByCategory/{category}', [ServicePageController::class, 'serviceByCategory'])->name('service-by-category');
