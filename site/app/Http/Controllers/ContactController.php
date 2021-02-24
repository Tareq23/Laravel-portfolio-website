<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
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
}
