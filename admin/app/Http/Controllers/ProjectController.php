<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;

class ProjectController extends Controller
{
    public function projectIndex()
    {
        return view('projects');
    }
    public function getAllProject()
    {
        $result = Projects::orderBy('id','desc')->get();
        return json_encode($result);
    }
    public function getSingleProject(Request $req)
    {
        $id = $req->input('id');

        $result = Projects::where('id',$id)->first();
        return json_encode($result);
    }

    public function addProject(Request $req)
    {
        $name = $req->input('name');
        $image = $req->input('image');
        $description = $req->input('description');


        $result = Projects::create([
            'name'=>$name,
            'image'=>$image,
            'description'=>$description
        ]);
        if($result)
        {
            return response()->json(
                ['status' => 200]
            );
        }
        return response()->json([
            'status'=> 500
        ]);
    }

    public function updateProject(Request $req)
    {
        $id = $req->input('id');
        $name = $req->input('name');
        $image = $req->input('image');
        $description = $req->input('description');


        $result = Projects::where('id',$id)->update([
            'name'=>$name,
            'image'=>$image,
            'description'=>$description
        ]);
        if($result)
        {
            return response()->json(
                ['status' => 200]
            );
        }
        return response()->json([
            'status'=> 500
        ]);
    }
    public function deleteProject(Request $req)
    {
        $id = $req->input('id');
        $result = Projects::where('id',$id)->delete();
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
