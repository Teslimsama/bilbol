<?php

namespace App\Http\Controllers\Auth;

use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordEmail;
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

        
        
        // Queue the job to send the password reset link (in other word this works if we want to send customized emails)
        // Mail::to($user->email)->queue(new ResetPasswordEmail($user));
        // Toastr::success(__('Password reset link will be sent shortly.'), 'Success');
        
        // User exists, proceed to send the password reset link
        $status = Password::sendResetLink($request->only('email'));
        
        switch ($status) {
            case Password::RESET_LINK_SENT:
                Toastr::success(__('Password reset link sent successfully.'), 'Success');
                break;

            case Password::INVALID_USER:
                Toastr::error(__('User with the provided email does not exist.'), 'Error');
                break;

            case Password::RESET_THROTTLED:
                Toastr::error(__('Too many reset attempts. Please wait before trying again.'), 'Error');
                break;

            default:
                Toastr::error(__('Unable to send password reset link.'), 'Error');
                break;
        }

        return redirect('login');
    }
}