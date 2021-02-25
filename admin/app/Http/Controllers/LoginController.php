<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // private $hashedPassword;
    public function loginIndex()
    {
        return view('login');
    }
    public function onLogin(Request $req)
    {
        $username = $req->input('username');
        
        $password = $req->input('password');
        //$result1 = json_decode(json_encode(Admin::where('username','=',$username)->first()));
        //$result = json_decode(Admin::where('username',$username)->get());
        $result = Admin::where('username',$username)->get();
        $pass =  $result[0]->password;
        if($pass===$password)
        {
            // $userStoredPassword = json_decode(Admin::select('password')->where('username',$username)->first());
            // //if(Hash::check($password,$userStoredPassword))
            // if($userStoredPassword->password==$password)
            // {
            // }
            $req->session()->put('username',$username);
            return response()->json([
                "status" => 200,
            ]);
        }
        return response()->json([
            'status'=> 500,
            'DBpass' => $result[0]->password,
            'clientPasss' => $password,
            // 'password' => $userStoredPassword,
        ]);
    }   

    public function onLogout(Request $req)
    {
        $req->session()->flush();
        return redirect('/login');
    }

    public function onRegistration(Request $req)
    {
        $password = Hash::make($req->input('password'));
        $name = $req->input('name');
        $username = $req->input('username');
        $email = $req->input('email');


        // $password = Hash::make($req->password);

        $result = Admin::insert([
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'email' => $email,
        ]);

        if($result)
        {
            return response()->json([
                'message' => "Registration Success",
            ]);
        }
        return response()->json([
            'message' => "Registration Failed",
        ]);
    }
}
