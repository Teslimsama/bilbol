<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $updateRecord = [
                'name' => $request->product_name,
                'description'   => $request->description,
                'quantity'   => $request->quantity,
                'price'   => $request->price,
            ];
            Inventory::where('id', $request->id)->update($updateRecord);

            Toastr::success('Has been update successfully :)', 'Success');
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, update inventory  :), '  . $e->getMessage(), 'Error');
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $inventoryEdit = inventory::where('id', $id)->first();
        return view('admin.edit_products', compact('inventoryEdit'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_name'    => 'required|string',
            'description'    => 'required|string',
            'quantity'    => 'required',
            'price'    => 'required',

        ]);

        try {
            DB::beginTransaction();

            $Inventory = new Inventory;
            $Inventory->name = $request->product_name;
            $Inventory->description   = $request->description;
            $Inventory->quantity   = $request->quantity;
            $Inventory->price   = $request->price;
            $Inventory->save();

            DB::commit();
            Toastr::success('Transaction completed successfully.', 'Success');
            // return view('admin.add_products');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Transaction failed: ' . $e->getMessage(), 'Error');
            return redirect()->back();
        }
    }
    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!empty($request->id)) {
                inventory::destroy($request->id);
                DB::commit();
                Toastr::success('inventory deleted successfully :)', 'Success');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('inventory deleted fail :)', 'Error');
            return redirect()->back();
        }
    }

}
