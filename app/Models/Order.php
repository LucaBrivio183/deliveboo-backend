<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // restaurant relationship (many-to-one)
    public function restaurant() 
    {
        return $this->belongsTo(Restaurant::class);
    }

    // products relationship (many-to-many)
    public function products() 
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
