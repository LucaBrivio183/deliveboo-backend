<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // Guarded data will not be auto-filled
    protected $guarded = [];
    //1 to many relation
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
