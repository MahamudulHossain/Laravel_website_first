<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CoursesModel;

class CoursesController extends Controller
{
  function coursesIndex(){
    return view('Courses');
  }
  function coursesData(){
    $res = json_encode(CoursesModel::orderBy('id','desc')->get());
    return $res;
  }
  function deleteCoursesData(Request $req){
    $id = $req->input('id');
    $res = CoursesModel::where('id',$id)->delete();
    if($res == true){
      return 1;
    }else{
      return 0;
    }
  }
  //edit
  function eachCourseData(Request $req){
    $id = $req->input('id');
    $res = json_encode(CoursesModel::where('id',$id)->get());
    return $res;
  }
  function updateCourseData(Request $req){
    $id = $req->input('id');
    $CourseTitle = $req->input('CourseTitle');
    $CourseDescription = $req->input('CourseDescription');
    $CourseFee = $req->input('CourseFee');
    $CourseEnroll = $req->input('CourseEnroll');
    $CourseClass = $req->input('CourseClass');
    $CourseLink = $req->input('CourseLink');
    $Img_path = $req->input('Img_path');
    $res = CoursesModel::where('id',$id)->update([
      'course_name'=>$CourseTitle,
      'course_des'=>$CourseDescription,
      'course_fee'=>$CourseFee,
      'course_totalenroll'=>$CourseEnroll,
      'course_totalclass'=>$CourseClass,
      'course_link'=>$CourseLink,
      'course_img'=>$Img_path
    ]);
    if($res == true){
      return 1;
    }else{
      return 0;
    }
  }
  //add
  function addCoursesData(Request $req){
    $addCourseTitle = $req->input('addCourseTitle');
    $addCourseDescription = $req->input('addCourseDescription');
    $addCourseFee = $req->input('addCourseFee');
    $addCourseEnroll = $req->input('addCourseEnroll');
    $addCourseClass = $req->input('addCourseClass');
    $addCourseLink = $req->input('addCourseLink');
    $addImg_path = $req->input('addImg_path');
    $res = CoursesModel::insert([
      'course_name'=>$addCourseTitle,
      'course_des'=>$addCourseDescription,
      'course_fee'=>$addCourseFee,
      'course_totalenroll'=>$addCourseEnroll,
      'course_totalclass'=>$addCourseClass,
      'course_link'=>$addCourseLink,
      'course_img'=>$addImg_path
    ]);
    if($res == true){
      return 1;
    }else{
      return 0;
    }
  }
}
