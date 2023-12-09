<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function inventory()
    {
        $inventoryList = Inventory::all();
        return view('admin.products', compact('inventoryList'));
    }
    public function inventoryAdd()
    {
        return view('admin.add_products');
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_name'    => 'required|string',
            'description'    => 'required|string',
            'quantity'    => 'required',
            'price'    => 'required',

        ]);

        DB::beginTransaction();
        try {
            if (!empty($request->product_name)) {
                // $Inventory = new Inventory;
                // $Inventory->name = $request->product_name;
                // $Inventory->description   = $request->description;
                // $Inventory->quantity   = $request->quantity;
                // $Inventory->price   = $request->price;
                // $Inventory->save();
                // dd($request->date);
                
                // Toastr::success('Has been add successfully :)', 'Success');
                // DB::commit();
                dd('fuck');
            }

            // return view('admin.add_products');
        } catch (\Exception $e) {
            // DB::rollback();
            // Toastr::error('fail, Add new Inventory  :)', 'Error');
            // return redirect()->back();
        }

        // return view('admin.add_products');
    }
}
