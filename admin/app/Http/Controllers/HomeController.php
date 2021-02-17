<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;


class HomeController extends Controller
{
    public function homeIndex()
    {
        return view('home');
    }
}
