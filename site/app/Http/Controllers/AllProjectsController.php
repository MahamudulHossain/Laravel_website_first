<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectsModel;

class AllProjectsController extends Controller
{
    function allprojects(){
    	$allprojects = json_decode(ProjectsModel::orderBy('id','desc')->get());
    	return view('allProjects',['allprojects'=>$allprojects]);
    }
}
