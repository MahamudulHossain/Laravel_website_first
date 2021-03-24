<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageUploadModel;

class ImageUploadController extends Controller
{
    function imageIndex(){
      return view('ImageUpload');
    }
    function loadImages(){
      $result = ImageUploadModel::take(4)->get();
      return $result;
    }
    function uploadPhoto(Request $req){
       $photoPath =  $req->file('photo')->store('public');
       $fileName = explode("/",$photoPath)[1];
       $finalName = "http://".$_SERVER['HTTP_HOST']."/storage/".$fileName;
       $res =ImageUploadModel::insert(['ImagePath'=>$finalName]);
       if($res == true){
         return 1;
       }else{
         return 0;
       }
    }
    function loadMorePhotos(Request $req){
      $first_Id = $req->id;
      $last_Id = $first_Id+4;
      $res = ImageUploadModel::where('id','>=',$first_Id)->where('id','<',$last_Id)->get();
      return $res;
    }
}
