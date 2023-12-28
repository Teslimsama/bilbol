<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('admin.profile');
    }
    public function updateProfile(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = $request->id;

            $request->validate([
                'firstname'      => 'required|string|max:255',
                'lastname'      => 'required|string|max:255',
                'phone_number'      => 'required|max:255',
                'email'     => 'required|string|email|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $user = User::find($id);

            if (!$user) {
                return redirect()->back()->with('error', 'Profile not found');
            }

            $updateRecord = [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
            ];

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete existing image file if it exists
                $existingImagePath = public_path("images/admin/{$user->image}");
                if (file_exists($existingImagePath) && is_file($existingImagePath)) {
                    unlink($existingImagePath);
                }

                $imageName = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('assets/images/admin/'), $imageName);

                $updateRecord['image'] = $imageName;
            }

            $user->update($updateRecord);



            Toastr::success('Profile Updated Successfully :)', 'Success');
            DB::commit();
            return redirect()->back()->with('message', 'Profile has been updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Profile Update Failed :) ' . $e->getMessage(), 'Error');
            return redirect()->back();
        }
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'different:current_password', 'confirmed', Rules\Password::defaults()],
        ]);
        // Get the authenticated user
        // $user = auth()->user();
        $id = $request->id;
        $user = User::find($id);
        // Update the user's password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Optionally, you can fire an event or perform other actions here
        Toastr::success('Password changed successfully!' , 'Success');
        return redirect()->back();
    }
}
