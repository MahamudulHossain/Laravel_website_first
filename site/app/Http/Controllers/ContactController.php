<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contactModel;

class ContactController extends Controller
{
    function contactSend(Request $req){
    	$name = $req->input('name');
    	$mobile = $req->input('mobile');
    	$email = $req->input('email');
    	$msg = $req->input('msg');
    	$result = contactModel::insert([
    		'contact_name'=>$name,
    		'contact_mobile'=>$mobile,
    		'contact_email'=>$email,
    		'contact_msg'=>$msg,
    	]);
    	if($result == true){
      		return 1;
    	}else{
     		 return 0;
    	}
    }
}
