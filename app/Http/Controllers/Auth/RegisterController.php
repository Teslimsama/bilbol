<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function storeUser(Request $request)
    {
        $request->validate([
            'firstname'      => 'required|string|max:255',
            'lastname'      => 'required|string|max:255',
            'phone_number'      => 'required|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $dt       = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        $name = $request->firstname . " " . $request->lastname;
        $image='noimage';
        $role = 'Renter';
        $users = new User();
        $users->name = $name;
        $users->image = $image;
        $users->email = $request->email;
        $users->join_date = $todayDate;
        $users->password = Hash::make($request->password);
        $users->phone_number = $request->phone_number;
        $users->role_name = $role;
        $users->save();
        // Correct way to call the success method
        // Toastr::success('Your success message', 'Success');

        Toastr::success('Create new account successfully :)', 'Success');
        // dd('done mf');
        return redirect('login');
    }
}
