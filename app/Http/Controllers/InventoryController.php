<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Supplier;
use App\Models\ProductSupplier;
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
        $suppliers = Supplier::all();
        $categories = Category::all();

        return view('admin.add_products', compact('categories', 'suppliers'));
    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = $request->id;

            $request->validate([
                'name' => 'required|min:3|unique:inventories,name,' . $id . '|regex:/^[a-zA-Z ]+$/',
                'serial_number' => 'required',
                'model' => 'required|min:3',
                'category_id' => 'required',
                'payments_price' => 'required',
                'quantity' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'supplier_id.*' => 'required|exists:suppliers,id',
                'supplier_price.*' => 'required|numeric|min:0',
            ]);

            $inventory = Inventory::find($id);

            if (!$inventory) {
                return redirect()->back()->with('error', 'Product not found');
            }

            $updateRecord = [
                'name' => $request->name,
                'serial_number' => $request->serial_number,
                'quantity' => $request->quantity,
                'model' => $request->model,
                'category_id' => $request->category_id,
                'payments_price' => $request->payments_price,
            ];

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete existing image file if it exists
                $existingImagePath = public_path("images/inventory/{$inventory->image}");
                if (file_exists($existingImagePath) && is_file($existingImagePath)) {
                    unlink($existingImagePath);
                }

                $imageName = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('assets/images/inventory/'), $imageName);

                $updateRecord['image'] = $imageName;
            }

            $inventory->update($updateRecord);

            // Update or create product suppliers
            foreach ($request->supplier_id as $key => $supplier_id) {
                $supplier = ProductSupplier::updateOrCreate(
                    ['inventory_id' => $inventory->id, 'supplier_id' => $supplier_id],
                    ['price' => $request->supplier_price[$key]]
                );
            }

            Toastr::success('Product Updated Successfully :)', 'Success');
            DB::commit();
            return redirect()->back()->with('message', 'Product has been updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Product Update Failed :) ' . $e->getMessage(), 'Error');
            return redirect()->back();
        }
    }



    public function edit($id)
    {
        $inventoryId = $id; // The specific product ID you want to retrieve associated ProductSupplier record for
        $additional = ProductSupplier::where('inventory_id', $inventoryId)->first();

        $inventory = inventory::findOrFail($id);
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('admin.edit_products', compact('additional', 'suppliers', 'categories', 'inventory'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:Inventories|regex:/^[a-zA-Z ]+$/',
            'serial_number' => 'required',
            'model' => 'required|min:3',
            'category_id' => 'required',
            'payments_price' => 'required',
            'quantity' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);


        $Inventory = new Inventory();
        $Inventory->name = $request->name;
        $Inventory->serial_number = $request->serial_number;
        $Inventory->model = $request->model;
        $Inventory->quantity = $request->quantity;
        $Inventory->category_id = $request->category_id;
        $Inventory->payments_price = $request->payments_price;


        // if ($request->hasFile('image')){
        //     $imageName =request()->image->getClientOriginalName();
        //     request()->image->move(public_path('images/Inventory/'), $imageName);
        //     $Inventory->image = $imageName;
        // }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/inventory/'), $imageName);
            $Inventory->image = $imageName;
        } else {
            $Inventory->image = 'noimage';
        }



        $Inventory->save();

        foreach ($request->supplier_id as $key => $supplier_id) {
            $supplier = new ProductSupplier();
            $supplier->inventory_id = $Inventory->id;
            $supplier->supplier_id = $request->supplier_id[$key];
            $supplier->price = $request->supplier_price[$key];
            $supplier->save();
        }
        Toastr::success('New Inventory Added Successfully', 'Success');
        return redirect()->back();
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
