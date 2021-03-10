<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\visitorModel;
use App\ServicesModel;

class HomeController extends Controller
{
    function visitorTracking(){

	$UserIP=$_SERVER['REMOTE_ADDR'];
    date_default_timezone_set("Asia/Dhaka");
	$timeDate= date("Y-m-d h:i:sa");

    visitorModel::insert(['ip_address'=>$UserIP,'visit_time'=>$timeDate]);

    $services = json_decode(ServicesModel::all());
    return view('Home',['services'=>$services]);
    }
}
