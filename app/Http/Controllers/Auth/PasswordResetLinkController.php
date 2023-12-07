<?php

namespace App\Http\Controllers\Auth;

use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot_password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // User with the provided email does not exist
            Toastr::error('Email does not exist in our records.', 'Error');
            return back()->withInput($request->only('email'));
        }

        // User exists, proceed to send the password reset link
        $status = Password::sendResetLink($request->only('email'));

        // Check the status and display Toastr messages accordingly
        return $status == Password::RESET_LINK_SENT
            ? Toastr::success(__('Password reset link sent successfully.'), 'Success')
            : Toastr::error(__('Unable to send password reset link.'), 'Error');
    }
}


// use Brian2694\Toastr\Facades\Toastr;

// // ...

// public function store(Request $request): RedirectResponse
// {
//     $request->validate([
//         'email' => ['required', 'email'],
//     ]);

//     // Check if the email exists in the database
//     $userExists = User::where('email', $request->email)->exists();

//     if (!$userExists) {
//         // User does not exist, display Toastr error message
//         Toastr::error('Email does not exist in the database.', 'Error');
//         return back()->withInput($request->only('email'));
//     }

//     // Attempt to send the password reset link
//     $status = Password::sendResetLink(
//         $request->only('email')
//     );

//     // Check the status and display Toastr messages
//     return $status == Password::RESET_LINK_SENT
//         ? Toastr::success(__('Password reset link sent successfully.'), 'Success')
//         : Toastr::error(__('Unable to send password reset link.'), 'Error');
// }
