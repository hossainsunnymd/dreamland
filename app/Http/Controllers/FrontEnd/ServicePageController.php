<?php

namespace App\Http\Controllers\FrontEnd;

use Inertia\Inertia;
use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicePageController extends Controller
{
    //service by category
    public function serviceByCategory($id){
        $serviceList=Services::where('service_category_id',$id)->get();
        return Inertia::render('ServiceByCategoryffff',['serviceList'=>$serviceList]);
    }
}
