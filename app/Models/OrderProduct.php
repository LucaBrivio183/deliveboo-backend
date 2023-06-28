<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Relations\Pivot;
 
class OrderProduct extends Pivot
{    
    /**
     * incrementing
     *
     * @var bool
     */
    public $incrementing = true;
}