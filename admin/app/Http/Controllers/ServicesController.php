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
}
