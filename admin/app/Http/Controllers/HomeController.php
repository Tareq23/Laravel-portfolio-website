<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Contact;
use App\Models\Projects;
use App\Models\Courses;
use App\Models\Services;
use App\Models\Review;


class HomeController extends Controller
{
    public function homeIndex()
    {
        $vistorCount = Visitor::count();
        $contactCount = Contact::count();
        $projectCount = Projects::count();
        $courseCount = Courses::count();
        $serviceCount = Services::count();
        $ReviewCount = Review::count();
        return view('home',[
            "visitorCount" => $vistorCount,
            "contactCount" => $contactCount,
            "projectCount" => $projectCount,
            "courseCount" => $courseCount,
            "serviceCount" => $serviceCount,
            "reviewCount" => $ReviewCount,
        ]);
    }
}
