<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
   public function index(){
    return view('client.index');
   }

   public function about(){
    return view('client.about');
   }

   public function shop(){
    return view('client.shop');
   }
   public function AdminIndex(){
    return view('admin.index');
   }

   public function furniture(){
    return view('client.furniture');
   }
   public function contact(){
    return view('client.contact');
   }
}
