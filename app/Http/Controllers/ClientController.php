<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\ProductSupplier;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ClientController extends Controller
{
   public function index()
   {
      $inventoryList = Inventory::latest()->limit(4)->get();
      return view('client.index', compact('inventoryList'));

   }

   public function about()
   {
      return view('client.about');
   }
   public function details($id)
   {
      $inventoryId = $id; // The specific product ID you want to retrieve associated ProductSupplier record for
      $additional = ProductSupplier::where('inventory_id', $inventoryId)->first();

      $inventory = inventory::findOrFail($id);
      return view('client.detail', compact('additional', 'inventory'));
   }

   public function shop()
   {
      $inventoryList = Inventory::all();
      return view('client.shop', compact('inventoryList'));
   }
   public function AdminIndex()
   {
      return view('admin.index');
   }

   public function furniture()
   {
      return view('client.furniture');
   }
   public function contact()
   {
      return view('client.contact');
   }
   public function cart()
   {
      $cart = session()->get('cart', []);
      return view('client.cart', compact('cart'));
   }
   public function checkout()
   {
      return view('client.checkout');
   }
}
