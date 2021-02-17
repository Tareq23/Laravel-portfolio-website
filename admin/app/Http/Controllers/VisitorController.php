<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function visitorIndex()
    {
        $visitorData = json_decode(Visitor::orderBy('id','DESC')->take(50)->get(),true);
        return view('visitor',['visitorData'=>$visitorData]);
    }
}
