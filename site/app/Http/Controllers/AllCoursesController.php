<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CoursesModel;

class AllCoursesController extends Controller
{
    function allCourses(){
    	$allcourses = json_decode(CoursesModel::orderBy('id','desc')->get());
    	return view('allCourses',['allcourses'=>$allcourses]);
    }
}
