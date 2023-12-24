<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'serial_number',
        'model',
        'category_id',
        'payments_price',
        'quantity',
        'image', // Assuming you have an 'image' column in your 'inventories' table
    ];
    public function renteds()
    {
        return $this->hasMany(Rented::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function additionalProduct()
    {
        return $this->hasMany(ProductSupplier::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}
