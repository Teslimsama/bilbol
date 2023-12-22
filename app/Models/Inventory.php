<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        
    ];
    public function renteds()
    {
        return $this->hasMany(Rented::class);
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }
    public function tax()
    {
        return $this->belongsTo('App\Tax');
    }

    public function additionalProduct()
    {
        return $this->hasMany('App\ProductSupplier');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}
