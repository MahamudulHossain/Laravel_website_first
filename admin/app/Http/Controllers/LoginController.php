<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\adminModel;

class LoginController extends Controller
{
    function loginIndex(){
      return view('Login');
    }
    function logout(Request $req){
      $req->session()->flush();
      return redirect('/Login');
    }
    function loginData(Request $req){
      $username = $req->input('username');
      $userpassword = $req->input('userpassword');
      $userData = adminModel::where('username',$username)->where('userpassword',$userpassword)->count();
      if($userData == 1){
        $req->session()->put('logIn',$username);
        return 1;
      }else{
        return 0;
      }
    }
}
