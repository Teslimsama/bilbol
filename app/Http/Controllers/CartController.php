<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\cart;
use App\Models\Inventory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function addToCart($id)
    {
        try {
            $inventory = Inventory::findOrFail($id);

            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                // $cart[$id]['quantity']++;
                $cart[$id]['quantity'] = (int)$cart[$id]['quantity'] + 1;
            } else {
                $cart[$id] = [
                    "name" => $inventory->name,
                    "image" => $inventory->image,
                    "payments_price" => $inventory->payments_price,
                    "quantity" => 1
                ];
            }

            session()->put('cart', $cart);
            session()->save();
            // dd(session());
            Toastr::success('Inventory added to cart successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            // Handle the case where the inventory item is not found
            Toastr::error('Inventory not found!', 'Error');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $newQuantity = $request->quantity;

            $cart[$request->id]["quantity"] = $newQuantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
    }
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                // Check if the cart is empty, and remove the 'cart' key if it is
                if (empty($cart)) {
                    session()->forget('cart');
                } else {
                    session()->put('cart', $cart);
                }
                session()->flash('success', 'Product successfully removed!');
            }
        }
    }
}
