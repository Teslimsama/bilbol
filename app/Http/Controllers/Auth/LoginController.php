<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'locked', 'unlock', 'login']);
    }


    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                // Store user-related information in the session
                session([
                    'name'         => $user->name,
                    'email'        => $user->email,
                    'id'           => $user->id,
                    'join_date'    => $user->join_date,
                    'phone_number' => $user->phone_number,
                    'status'       => $user->status,
                    'role_name'    => $user->role_name,
                    'image'        => $user->image,
                ]);

                Toastr::success('Login successfully :)', 'Success');
                return redirect()->intended('dashboard');
            } else {
                Toastr::error('Fail, WRONG USERNAME OR PASSWORD :)', 'Error');
                return redirect('login');
            }
        } catch (\Exception $e) {
            Toastr::error('Fail, LOGIN :)', 'Error');
            return redirect()->back();
        }
    }

    /** logout */
    public function logout(Request $request)
    {
        Auth::logout();

        // Clear all session data
        $request->session()->invalidate();

        // Redirect to the login page
        return redirect()->route('login');
    }

}
