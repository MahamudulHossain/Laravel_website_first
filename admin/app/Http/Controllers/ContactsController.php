<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contactModel;

class ContactsController extends Controller
{
    function contactsIndex(){
      return view('Contact');
    }
    function contactsData(){
      $res = json_encode(contactModel::orderBy('id','desc')->get());
      return $res;
    }
    function deleteContactsData(Request $req){
      $id = $req->input('id');
      $res = contactModel::where('id',$id)->delete();
      if($res == true){
        return 1;
      }else{
        return 0;
      }
    }
}
