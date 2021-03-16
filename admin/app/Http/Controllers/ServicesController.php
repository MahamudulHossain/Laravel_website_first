<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServicesModel;

class ServicesController extends Controller
{
  function servicesIndex(){
    return view('Services');
  }

  function servicesData(){
    $res = json_encode(ServicesModel::orderBy('id','desc')->get());
    return $res;
  }
  function deleteServicesData(Request $req){
    $id = $req->input('id');
    $res = ServicesModel::where('id',$id)->delete();
    if($res == true){
      return 1;
    }else{
      return 0;
    }
  }

  function eachServicesData(Request $req){
    $id = $req->input('id');
    $res = json_encode(ServicesModel::where('id',$id)->get());
    return $res;
  }
  function updateServicesData(Request $req){
    $id = $req->input('id');
    $title = $req->input('title');
    $short_desc = $req->input('short_desc');
    $img_path = $req->input('img_path');
    $res = ServicesModel::where('id',$id)->update(['title'=>$title,'short_desc'=>$short_desc,'img_path'=>$img_path]);
    if($res == true){
      return 1;
    }else{
      return 0;
    }
  }

  function addServicesData(Request $req){
    $title = $req->input('title');
    $short_desc = $req->input('short_desc');
    $img_path = $req->input('img_path');
    $res = ServicesModel::insert(['title'=>$title,'short_desc'=>$short_desc,'img_path'=>$img_path]);
    if($res == true){
      return 1;
    }else{
      return 0;
    }
  }

}
