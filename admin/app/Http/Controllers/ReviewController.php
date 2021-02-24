<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function reviewIndex()
    {
        return view('review');
    }
    public function getAllReview()
    {
        return Review::orderBy('id','desc')->get();
    }
    public function getReviewDetails(Request $req)
    {
        $result = Review::find($req->input('id'));
        return $result;
        if($result)
        {
            return response()->json([
                'status'=>200
            ]);
        }
        return response()->json(['status'=>500]);
    }
    public function reviewUpdate(Request $req)
    {
        $id = $req->input('id');
        $name = $req->input('name');
        $description = $req->input('description');
        $image = $req->input('image');

        $result = Review::where('id',$id)->update([
            'name' => $name,
            'image' => $image,
            'description' => $description,
        ]);
        if($result)
        {
            return response()->json([
                'status' => 200,
            ]);
        }
        return response()->json([
            'status' => 500,
            'data' => $id,
            'result' => $result,
        ]);
    }
    public function deleteReview(Request $req)
    {
        $id = $req->input('id');
        $result = Review::where('id',$id)->delete();
        if($result)
        {
            return response()->json([
                'status'=>200,
            ]);
        }
        return response()->json([
            'status' => 500
        ]);
    }
    public function addReview(Request $req)
    {
        $name = $req->input('name');
        $description = $req->input('description');
        $image = $req->input('image');

        $result = Review::insert([
            'name' => $name,
            'image' => $image,
            'description' => $description,
        ]);
        if($result)
        {
            return response()->json([
                'status' => 200,
            ]);
        }
        return response()->json([
            'status' => 500,
        ]);
    }
}
