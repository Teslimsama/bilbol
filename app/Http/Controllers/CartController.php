<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\cart;
use App\Models\Inventory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{


    public function addToCart($id, $qty)
    {
        try {
            // Validate $id and $qty
            // For example, you can use the numeric rule for $qty
            // $this->validate([
            //     'id' => 'numeric',
            //     'qty' => 'numeric',
            // ]);

            $inventory = Inventory::findOrFail($id);

            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = (int) $cart[$id]['quantity'] + (int) $qty;
            } else {
                $cart[$id] = [
                    "id" => $inventory->id,
                    "name" => $inventory->name,
                    "image" => $inventory->image,
                    "payments_price" => $inventory->payments_price,
                    "quantity" => (int) $qty,
                ];
            }

            session()->put('cart', $cart);
            session()->save();

            Toastr::success('Inventory added to cart successfully!', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e);
            Toastr::error('An error occurred while adding to the cart!', 'Error');
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
