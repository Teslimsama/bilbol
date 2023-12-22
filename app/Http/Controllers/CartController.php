<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\cart;
use App\Models\Inventory;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function addToCart($id)
    {
        try {
            $inventory = Inventory::findOrFail($id);

            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    "inventory_name" => $inventory->inventory_name,
                    "photo" => $inventory->photo,
                    "price" => $inventory->price,
                    "quantity" => 1
                ];
            }

            session()->put('cart', $cart);
            session()->save();

            return redirect()->back()->with('success', 'Inventory added to cart successfully!');
        } catch (ModelNotFoundException $exception) {
            // Handle the case where the inventory item is not found
            return redirect()->back()->with('error', 'Inventory not found!');
        }
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $newQuantity = $request->quantity;

            if ($request->has('action') && $request->action == 'plus') {
                // Increment quantity for plus action
                $newQuantity++;
            } elseif ($request->has('action') && $request->action == 'minus' && $newQuantity > 1) {
                // Decrement quantity for minus action, but ensure it doesn't go below 1
                $newQuantity--;
            }

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
