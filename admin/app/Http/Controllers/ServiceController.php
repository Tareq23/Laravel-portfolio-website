<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;


class ServiceController extends Controller
{
    public function serviceIndex()
    {
        $data = Services::all();
        return view('components.services');
    }
    public function getServiceAll()
    {
        $result = json_encode(Services::all());
        return $result;
    }
    public function serviceDelete(Request $req)
    {
        $id = $req->input('idd');
        $result = Services::where('id',$id)->delete();
        if($result==true)
        {
            return response()->json([
                "status" => 200,
                'message' => "Data Successfully Deleted"
            ]);
        }
        else{
            return response()->json([
                "status" => 500,
                'message' => $id,
            ]);
            
        }
    }
}
