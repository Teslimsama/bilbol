<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSupplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'inventory_id',// Assuming you have an 'image' column in your 'inventories' table
        'supplier_id',// Assuming you have an 'image' column in your 'inventories' table
        'price',// Assuming you have an 'image' column in your 'inventories' table
    ];
    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }


}
