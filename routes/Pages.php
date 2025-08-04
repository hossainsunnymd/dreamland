<?php

use App\Http\Controllers\FrontEnd\CountryPageController;
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
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/guides', [PageController::class, 'guides'])->name('guides');
Route::get('/packages', [PageController::class, 'packages'])->name('packages');
Route::get('/testimonial', [PageController::class, 'testimonial'])->name('testimonial');
Route::get('/tour', [PageController::class, 'tour'])->name('tour');



Route::get('/page-view/{page}',[PageController::class,'page'])->name('page');



//service by category

Route::get('/service-by-category/{id}', [ServicePageController::class, 'serviceByCategory'])->name('service-by-category');


//country by id

Route::get('/country-by-id/{id}', [CountryPageController::class, 'countryById'])->name('country-by-id');
