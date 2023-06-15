<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['slug', 'image'];

    //restaurant relationship
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
