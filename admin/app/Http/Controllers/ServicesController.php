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
    $res = json_encode(ServicesModel::all());
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
}
