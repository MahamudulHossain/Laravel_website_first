<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectsModel;

class ProjectsController extends Controller
{
  function projectsIndex(){
    return view('Projects');
  }
  function projectsData(){
    $res = json_encode(ProjectsModel::orderBy('id','desc')->get());
    return $res;
  }
  function deleteProjectsData(Request $req){
    $id = $req->input('id');
    $res = ProjectsModel::where('id',$id)->delete();
    if($res == true){
      return 1;
    }else{
      return 0;
    }
  }
  //edit
  function eachProjectData(Request $req){
    $id = $req->input('id');
    $res = json_encode(ProjectsModel::where('id',$id)->get());
    return $res;
  }
  function updateProjectData(Request $req){
    $id = $req->input('id');
    $ProjectTitle = $req->input('ProjectTitle');
    $ProjectDescription = $req->input('ProjectDescription');
    $ProjectLink = $req->input('ProjectLink');
    $Project_Img_path = $req->input('Project_Img_path');
    $res = ProjectsModel::where('id',$id)->update([
      'project_name'=>$ProjectTitle,
      'project_des'=>$ProjectDescription,
      'project_link'=>$ProjectLink,
      'project_img'=>$Project_Img_path
    ]);
    if($res == true){
      return 1;
    }else{
      return 0;
    }
  }
  //Add Projects
  function addProjectsData(Request $req){
    $addProjectTitle = $req->input('addProjectTitle');
    $addProjectDescription = $req->input('addProjectDescription');
    $addProjectLink = $req->input('addProjectLink');
    $add_Project_Img_path = $req->input('add_Project_Img_path');
    $res = ProjectsModel::insert([
      'project_name'=>$addProjectTitle,
      'project_des'=>$addProjectDescription,
      'project_link'=>$addProjectLink,
      'project_img'=>$add_Project_Img_path
    ]);
    if($res == true){
      return 1;
    }else{
      return 0;
    }
  }
}
