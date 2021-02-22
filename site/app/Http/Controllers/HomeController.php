<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Services;
use App\Models\Courses;

class HomeController extends Controller
{
    public function homeIndex()
    {
        $userIpAddress = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $dateTime = date("Y-m-d h:i:sa");
        Visitor::insert([
            'ip_address' => $userIpAddress,
            'visit_time' => $dateTime
        ]);

        $servicesData = json_encode(Services::all(),true);
        $courseData = json_encode(Courses::orderBy('id','desc')->limit(6)->get());
        return view('home',[
            'servicesData'=>json_decode($servicesData),
            'coursesData'=>json_decode($courseData),
        ]);
    }
}
