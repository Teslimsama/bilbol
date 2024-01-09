<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\Inventory;
use App\Models\Payment;
use App\Models\Rented;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class RentedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $renteds = Rented::with('payments')->get();
        return view('admin.rented', compact('renteds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rentedAdd()
    {
        $users = user::all();
        $inventorys = inventory::all();
        return view('admin.add_rented', compact('users', 'inventorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'inventory_id' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'return_date' => 'required',
            'rented_date' => 'required',
            'dis' => 'required',
            'amount' => 'required',
        ], [
            'user_id.required' => 'The user is required.',
            'inventory_id.required' => 'The inventory is required.',
            // Add similar messages for other fields
        ]);
        $txRef = 'Bilbol' . rand(99999, 10000000) . '_CASH';
        $txId = ($request->qty) ? 0 : $request->qty;
        $rented = new Rented(); // Follow Laravel conventions for model names
        $rented->user_id = $request->user_id;
        $rented->total = 1000; // You might want to calculate this based on your requirements
        $rented->save();

        foreach ($request->inventory_id as $key => $inventory_id) {
            $payment = new Payment(); // Follow Laravel conventions for model names
            $payment->qty = $request->qty[$key];
            $payment->price = $request->price[$key];
            $payment->tx_ref = $txRef;
            $payment->tx_id = $txId;
            $payment->dis = $request->dis[$key];
            $payment->rented_date = $request->rented_date[$key];
            $payment->return_date = $request->return_date[$key];
            $payment->amount = $request->amount[$key];
            $payment->inventory_id = $request->inventory_id[$key];
            $payment->rented_id = $rented->id;
            $payment->save();
        }
        Toastr::success('Rented Inventory Added Successfully :)', 'Success');
        return redirect('rented/edit/' . $rented->id);
    }

    public function findPrice(Request $request)
    {
        $data = DB::table('inventories')->select('payments_price')->where('id', $request->id)->first();
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rented = rented::findOrFail($id);
        $payments = payment::where('rented_id', $id)->get();
        return view('admin.show_rented', compact('rented', 'payments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = user::all();
        $inventorys = inventory::orderBy('id', 'DESC')->get();
        $rented = rented::findOrFail($id);
        $payments = payment::where('rented_id', $id)->get();
        return view('admin.edit_rented', compact('users', 'inventorys', 'rented', 'payments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([

            'user_id' => 'required',
            'inventory_id' => 'required',
            'qty' => 'required',
            'return_date' => 'required',
            'rented_date' => 'required',
            'price' => 'required',
            'dis' => 'required',
            'amount' => 'required',
        ]);
        $id = $request->id;
        $rented = rented::findOrFail($id);
        $rented->user_id = $request->user_id;
        $rented->total = 1000;
        $rented->save();

        payment::where('rented_id', $id)->delete();
        $txRef = 'Bilbol' . rand(99999, 10000000) . '_CASH';
        $txId = ($request->qty) ? 0 : $request->qty;
        foreach ($request->inventory_id as $key => $inventory_id) {
            $payment = new payment();
            $payment->qty = $request->qty[$key];
            $payment->price = $request->price[$key];
            $payment->tx_ref = $txRef;
            $payment->tx_id = $txId;
            $payment->dis = $request->dis[$key];
            $payment->rented_date = $request->rented_date[$key];
            $payment->return_date = $request->return_date[$key];
            $payment->amount = $request->amount[$key];
            $payment->inventory_id = $request->inventory_id[$key];
            $payment->rented_id = $rented->id;
            $payment->save();
        }
        Toastr::success('Rented Inventory Updated Successfully :)', 'Success');
        return redirect('/rented/edit/' . $rented->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {
        $id = $request->id;
        Payment::where('rented_id', $id)->delete();
        $rented = Rented::findOrFail($id); // Follow Laravel conventions for model names
        $rented->delete();
        Toastr::success('Rented Inventory Deleted successfully :)', 'Success');
        return redirect()->route('admin.rented'); // Adjust the route based on your application's logic
    }
}
