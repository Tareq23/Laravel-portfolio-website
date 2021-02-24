<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{


    public function contactIndex()
    {
        return view('contact');// return Contact::orderBy('id','desc')->get();
    }

    public function getAllContact()
    {
        // return Contact::orderBy('id','desc')->get();
        return Contact::all();
    }


    public function addContact(Request $req)
    {   
        $name = $req->input('name');
        $message = $req->input('message');
        $phone = $req->input('phone');
        $email = trim($req->input('email'),' ');
        $result = Contact::create([
            'name' => $name,
            'message' => $message,
            'email' => $email,
            'phone' => $phone
        ]);
        if($result)
        {
            return response()->json([
                'status'=>200,
            ]);
        }
        return response()->json([
            'status'=>500
        ]);
    }

    public function contactDetails(Request $req)
    {
        $id = $req->input('id');
        $result = Contact::where('id',$id)->first();
        return $result;
    }   

    public function deleteContact(Request $req)
    {
        $id = $req->input('id');
        $result = Contact::where('id',$id)->delete();
        if($result)
        {
            return response()->json([
                'status'=>200,
            ]);
        }
        return response()->json([
            'status'=>500,
        ]);
    }
}
