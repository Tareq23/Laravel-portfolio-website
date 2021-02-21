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



    public function singleServiceAdd(Request $req)
    {
        $name = $req->input('name');
        $desc = $req->input('desc');
        $image = $req->input('image');
        $data = [
            'name' => $name,
            'description' => $desc,
            'image' => $image
        ];
        $result = Services::insert($data);
        if($result==1)
        {
            return response()->json([
                'message' => "Data Add Successfully"
            ]);
        }
        return response()->json([
            'message' => "something went wrong"
        ]);
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
                'message' => "Delete failed!",
            ]);
            
        }
    }

    public function singleServiceGet(Request $req)
    {
        $id = $req->input('id');
        $result = Services::find($id);
        return json_encode($result);
    }
    public function singleServiceUpdate(Request $req)
    {
        $id = $req->input('id');
        $desc = $req->input('desc');
        $name = $req->input('name');
        $image = $req->input('image');

        try{
            $service = Services::find($id);
            $service->name=$name;
            $service->description =$desc;
            $service->image = $image;
            $result = $service->save();
            if($result)
            {
                return response()->json([
                    "status" => 200,
                    'message' => "Data Successfully Updated",
                ]);
            }
            else{
                return response()->json([
                    "status" => 500,
                    'message' => "Update failed!",
                ]);
                
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
        
    }
}
