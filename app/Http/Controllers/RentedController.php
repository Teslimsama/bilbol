<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RentedController extends Controller
{
    public function rented()
    {
        return view('admin.rented');
    }
}
