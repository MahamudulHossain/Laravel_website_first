<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contactModel;
use App\CoursesModel;
use App\ProjectsModel;
use App\ReviewModel;
use App\ServicesModel;
use App\VisitorModel;

class HomeController extends Controller
{

    function homeIndex(){
      $conCount = contactModel::count();
      $vsCount = VisitorModel::count();
      $crsCount = CoursesModel::count();
      $proCount = ProjectsModel::count();
      $rvwCount = ReviewModel::count();
      $serCount = ServicesModel::count();
      return view('home',[
        'conCount'=>$conCount,
        'vsCount'=>$vsCount,
        'crsCount'=>$crsCount,
        'proCount'=>$proCount,
        'rvwCount'=>$rvwCount,
        'serCount'=>$serCount
      ]);
    }
}
