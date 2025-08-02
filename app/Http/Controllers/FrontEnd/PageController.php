<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Booking;
use App\Models\Country;
use App\Models\Services;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

    //Dashboard page
    public function dashboard(){
        return Inertia::render('BackEnd/DashBoardPage');
    }

    //profile
    public function profile(){
        $userId=Auth::user()->id;
        $profile=User::find($userId);
        return Inertia::render('ProfilePage',['profile'=>$profile]);
    }

    //student dashboard page
    public function studentDashboard(){
        $userId=Auth::check()?Auth::user()->id:0;
        $bookings=Booking::where('user_id',$userId)->get();
        return Inertia::render('FrontEnd/StudentDashBoardPage',['bookings'=>$bookings]);
    }

    //login page
    public function login(){
        return Inertia::render('FrontEnd/Auth/LoginPage');
    }

    //register page
    public function register(){
        return Inertia::render('FrontEnd/Auth/RegistrationPage');
    }

    //home page
    public function home(){
        $countries=Country::all();
        return Inertia::render('FrontEnd/HomePage',['countries'=>$countries]);
    }

    //about page
    public function about(){
        return Inertia::render('FrontEnd/AboutPage');
    }

    //blog page
    public function blog(){
        return Inertia::render('FrontEnd/BlogPage');
    }

    //tour
    public function tour(){
        return Inertia::render('FrontEnd/TourPage');
    }

    //contact page
    public function contact(){
        return Inertia::render('FrontEnd/ContactPage');
    }
    //booking
    public function booking(){
        $countries=Country::all();
        return Inertia::render('FrontEnd/BookingPage',['countries'=>$countries]);
    }

    //destination
    public function destination(){
        return Inertia::render('FrontEnd/DestinationPage');
    }

    //gallery
    public function gallery(){
        return Inertia::render('FrontEnd/GalleryPage');
    }

    //services
    public function services(){
        $services=Services::all();
        return Inertia::render('FrontEnd/ServicesPage',['services'=>$services]);
    }

    //guides
    public function guides(){
        return Inertia::render('FrontEnd/GuidesPage');
    }

    // packages
    public function packages(){
        return Inertia::render('FrontEnd/PackagesPage');
    }

    //testimonial
    public function testimonial(){
        return Inertia::render('FrontEnd/TestimonialPage');
    }
}
