<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageUploadModel;

class ImageUploadController extends Controller
{
    function imageIndex(){
      return view('ImageUpload');
    }
    function uploadPhoto(Request $req){
       $photoPath =  $req->file('photo')->store('public');
       $res =ImageUploadModel::insert(['ImagePath'=>$photoPath]);
       if($res == true){
         return 1;
       }else{
         return 0;
       }
    }
}
