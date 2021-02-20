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
        //echo $id;
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
        // return response()->json(
        //     $result
        // );
    }
    public function singleServiceUpdate(Request $req)
    {
        $id = $req->input('id');
        $desc = $req->input('desc');
        $name = $req->input('name');
        $image = $req->input('image');

        try{
            // $result = Services::where('id',$id)->update([
            //     'description' => $desc,
            //     'image' => $image,
            //     'name' => $name,
            // ]);
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
                    // 'service' => $service,
                    'result' => $result,
                ]);
            }
            else{
                return response()->json([
                    "status" => 500,
                    'message' => "Update failed!",
                    // 'result' => $result,
                    // 'id' => $id,
                    // 'name'=>$name,
                    // 'desc'=>$desc,
                    // 'image'=>$image,
                    // 'service'=>$service,
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
