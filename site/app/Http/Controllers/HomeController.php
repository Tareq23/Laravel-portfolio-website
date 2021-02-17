<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;

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
        return view('home');
    }
}
