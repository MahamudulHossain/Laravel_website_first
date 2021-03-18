<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReviewModel;

class ReviewsController extends Controller
{
  function reviewsIndex(){
    return view('Reviews');
  }
  function reviewsData(){
    $res = json_encode(ReviewModel::orderBy('id','desc')->get());
    return $res;
  }
  function deleteReviewsData(Request $req){
    $id = $req->input('id');
    $res = ReviewModel::where('id',$id)->delete();
    if($res == true){
      return 1;
    }else{
      return 0;
    }
  }
  //edit
  function eachReviewData(Request $req){
    $id = $req->input('id');
    $res = json_encode(ReviewModel::where('id',$id)->get());
    return $res;
  }
  function updateReviewData(Request $req){
    $id = $req->input('id');
    $ReviewName = $req->input('ReviewName');
    $ReviewDescription = $req->input('ReviewDescription');
    $Review_Img_path = $req->input('Review_Img_path');
    $res = ReviewModel::where('id',$id)->update([
      'name'=>$ReviewName,
      'desc'=>$ReviewDescription,
      'image'=>$Review_Img_path
    ]);
    if($res == true){
      return 1;
    }else{
      return 0;
    }
  }
  //Add Reviews
  function addReviewsData(Request $req){
    $addReviewName = $req->input('addReviewName');
    $addReviewDescription = $req->input('addReviewDescription');
    $add_Review_Img_path = $req->input('add_Review_Img_path');
    $res = ReviewModel::insert([
      'name'=>$addReviewName,
      'desc'=>$addReviewDescription,
      'image'=>$add_Review_Img_path
    ]);
    if($res == true){
      return 1;
    }else{
      return 0;
    }
  }
}
