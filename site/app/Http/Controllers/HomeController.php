<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\visitorModel;
use App\ServicesModel;
use App\CoursesModel;
use App\ProjectsModel;
use App\ReviewModel;

class HomeController extends Controller
{
    function visitorTracking(){

	$UserIP=$_SERVER['REMOTE_ADDR'];
    date_default_timezone_set("Asia/Dhaka");
	$timeDate= date("Y-m-d h:i:sa");

    visitorModel::insert(['ip_address'=>$UserIP,'visit_time'=>$timeDate]);

    $services = json_decode(ServicesModel::all());
    $courses = json_decode(CoursesModel::orderBy('id','desc')->limit(6)->get());
    $projects = json_decode(ProjectsModel::orderBy('id','desc')->limit(6)->get());
    $reviews = json_decode(ReviewModel::orderBy('id','desc')->limit(5)->get());
    return view('Home',[
    	'services'=>$services,
    	'courses'=>$courses,
        'projects'=>$projects,
    	'reviews'=>$reviews
    ]);
    }
}
