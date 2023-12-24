<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rented extends Model
{
    use HasFactory;
   
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function payments()
    {
        return $this->hasOne(Payment::class, 'rented_id');
    }
    public function inventory()
    {
        return $this->belongsToMany(Inventory::class, 'renteds', 'payments_id', 'inventory_id')
        ->withPivot(['quantity', 'price']);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function sale()
    // {
    //     return $this->hasMany('App\Sales');
    // }

    // public function customer()
    // {
    //     return $this->belongsTo('App\Customer');
    // }

}
