<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;

class CourseController extends Controller
{
    public function courseIndex(){
        return view('components.courses');
    }
    public function allCourse()
    {
        $result = Courses::orderBy('id','desc')->select('id','name','total_enroll','total_class')->get();
        return $result;
    }
    public function courseDelete(Request $req)
    {
        $id = $req->input('id');
        $result = Courses::where('id',$id)->delete();
        if($result){
            return response()->json([
                'message' => "Data Successfully Deleted!",
                'result' => $result,
                ]);
        }
        else{
            return response()->json([
                'message' => "Data Successfully Deleted!",
                'result' => $result,
                ]);
        }

    }
    public function courseUpdate(Request $req)
    {
        $id = $req->input('id');
        $name = $req->input('name');
        $enroll = $req->input('enroll');
        $class = $req->input('class');
        $fee = $req->input('fee');
        $link = $req->input('link');
        $desc = $req->input('desc');
        $image = $req->input('image');
        $data = [
            'name' => $name,
            'total_enroll' => $enroll, 
            'total_class' => $class,
            'total_fee' => $fee,
            'description' => $desc,
            'image' => $image,
            'link' => $link
        ];
        $result = Courses::where('id',$id)->update($data);
        if($result)
        {
            return response()->json([
                'status' => 200,
                'message' => "Data Update Successfully",
            ]);
        }
        return response()->json([
            'status' => 500,
            'message' => "Data Update Failed",
        ]);
    }
    public function courseDetials(Request $req)
    {
        $id = $req->input('id');
        $result = Courses::find($id);
        return $result;
        
    }
    public function courseAdd(Request $req)
    {
        $name = $req->input('name');
        $enroll = $req->input('enroll');
        $class = $req->input('class');
        $fee = $req->input('fee');
        $link = $req->input('link');
        $desc = $req->input('desc');
        $image = $req->input('image');
        $data = [
            'name' => $name,
            'total_enroll' => $enroll, 
            'total_class' => $class,
            'total_fee' => $fee,
            'description' => $desc,
            'image' => $image,
            'link' => $link
        ];
        $result = Courses::insert($data);
        if($result)
        {
            return response()->json([
                'message' => "Data Update Successfully",
            ]);
        }
        return response()->json([
            'message' => "Data Update Failed",
        ]);
    }
}
