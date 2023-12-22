<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function users()
    {
        $UsersList = User::all();
        return view('admin.users', compact('UsersList'));
    }
    public function create()
    {
        return view('admin.add_users');
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_name'    => 'required|string',
            'address'    => 'required|string',
            'phone_number'    => 'required|max:255',
            'email'    => 'required|string|email|max:255|unique:users',

        ]);

        $image = 'noimage';
        $role = 'Renter';
        $dt       = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        try {
            DB::beginTransaction();

            $User = new User;
            $User->name = $request->user_name;
            $User->address   = $request->address;
            $User->phone_number   = $request->phone_number;
            $User->email   = $request->email;
            $User->role_name = $role;
            $User->image = $image;
            $User->join_date = $todayDate;
            $User->password = bcrypt('default_password');
            $User->save();

            DB::commit();
            Toastr::success('User Added Successfully :)', 'Success');            // return view('admin.add_products');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('User Added failed: ' . $e->getMessage(), 'Error');
            // echo $e->getMessage();
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $userEdit = user::where('id', $id)->first();
        return view('admin.edit_users', compact('userEdit'));
    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $updateRecord = [
                'name' => $request->user_name,
                'address'   => $request->address,
                'phone_number'   => $request->phone_number,
                'email'   => $request->email,
            ];
            User::where('id', $request->id)->update($updateRecord);

            Toastr::success('User Updated Successfully :)', 'Success');
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('User Update Failed :) ' . $e->getMessage(), 'Error');
            return redirect()->back();
        }
    }
    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!empty($request->id)) {
                user::destroy($request->id);
                DB::commit();
                Toastr::success('User Deleted successfully :)', 'Success');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('User Delete Failed :)', 'Error');
            return redirect()->back();
        }
    }
}
