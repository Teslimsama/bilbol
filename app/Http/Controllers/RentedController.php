<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rented;
use Illuminate\Http\Request;

class RentedController extends Controller
{
    public function rented()
    {
        $rentedList = Rented::all();
        return view('admin.rented', compact('rentedList'));
    }
    public function rentedAdd()
    {
        return view('admin.add_rented');
    }
    public function store()
    {
        return view('admin.rented');
    }
    public function edit()
    {
        return view('admin.rented');
    }
}
