<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VisitorModel;

class VisitorController extends Controller
{
  function visitorIndex(){
    $visitorData = json_decode(VisitorModel::all());
    //$visitorData = json_decode(VisitorModel::orderBy('id','desc')->take(10)->get());


    return view('Visitor',['visitorData'=>$visitorData]);
  }
}
