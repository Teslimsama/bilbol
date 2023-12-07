<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function forgot_password()
    {
        return view('auth.forgot_password');
    }
}
