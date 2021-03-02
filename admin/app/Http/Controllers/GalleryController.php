<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class GalleryController extends Controller
{
    public function galleryIndex()
    {
        return view('gallery');
    }

    public function imageJson()
    {
        return Image::limit(6)->get();
    }


    public function onScrollImage(Request $req)
    {
        $id1 = $req->input('id');
        $id2 = $id1 + 6;
        $result = Image::where('id','>',$id1)->where('id','<=',$id2)->get();
        return $result;
    }

    public function imageUpload(Request $req)
    {
        $hostName = $_SERVER['HTTP_HOST'];
        
        $http = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$hostName;

        $imagePath  = $req->file('image')->store('public');
        $imgName = (explode('/',$imagePath))[1];
        $location = $http."/"."storage/".$imgName;
        $result = Image::insert([
            'url' => $location,
        ]);
        if($result)
        {
            return $result;
        }
        return $result;
        // return $location;
        // return $imagePath;
    }
    public function deleteImage(Request $req)
    {
        $id = $req->input('id');
        $url = $req->input('url');
        return [
            'id' => $id,
            'url' => $url
        ];
    }
}
