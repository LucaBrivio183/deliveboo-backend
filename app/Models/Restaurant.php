<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    // Guarded data will not be auto-filled
    protected $guarded = ['slug', 'image', 'user_id'];

    //product relationship
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
