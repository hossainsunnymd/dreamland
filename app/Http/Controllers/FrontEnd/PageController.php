<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Page;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Booking;
use App\Models\Country;
use App\Models\Services;
use App\Http\Controllers\Controller;
use App\Models\Logo;
use App\Models\ServiceCategory;
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
        $aboutContent=Page::where('page_name','About')->first();
        return Inertia::render('FrontEnd/AboutPage',['aboutContent'=>$aboutContent]);
    }

    //blog page
    public function blog(){
        $blog=Page::where('page_name','Blog')->first();
        return Inertia::render('FrontEnd/BlogPage',['blog'=>$blog]);
    }

    //tour
    public function exploreTour(){
        $tour=Page::where('page_name','Explore Tour')->first();
        return Inertia::render('FrontEnd/TourPage',['tour'=>$tour]);
    }

    //contact page
    public function contact(){
        return Inertia::render('FrontEnd/ContactPage');
    }
    //booking
    public function travelBooking(){
        $countries=Country::all();
        $booking=Page::where('page_name','Travel Booking')->first();
        return Inertia::render('FrontEnd/BookingPage',['countries'=>$countries,'booking'=>$booking]);
    }

    //destination
    public function destination(){
        $destination=Page::where('page_name','Destination')->first();
        return Inertia::render('FrontEnd/DestinationPage' ,['destination'=>$destination]);
    }

    //gallery
    public function ourGallery(){
        $gallery=Page::where('page_name','Our Gallery')->first();
        return Inertia::render('FrontEnd/GalleryPage' ,['gallery'=>$gallery]);
    }

    //services
    public function services(){
        $serviceCategories=ServiceCategory::all();
        $logo=Logo::where('content_name','Services')->first();
        return Inertia::render('FrontEnd/ServicesPage',['serviceCategories'=>$serviceCategories,'logo'=>$logo,]);
    }

    //guides
    public function guides(){
        return Inertia::render('FrontEnd/GuidesPage');
    }

    // packages
    public function packages(){
        $packages=Page::where('page_name','Packages')->first();
        return Inertia::render('FrontEnd/PackagesPage',['packages'=>$packages]);
    }

    //testimonial
    public function testimonial(){
        $testimonial=Page::where('page_name','Testimonial')->first();
        return Inertia::render('FrontEnd/TestimonialPage',['testimonial'=>$testimonial]);
    }
}
