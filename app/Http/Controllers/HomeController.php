<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index(){
    return view('client.index');
   }

   public function indexc(Request $request){
    return view('client.index');
   }
}
