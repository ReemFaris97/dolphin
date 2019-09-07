<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductQuantity extends Model
{
    protected $fillable = ['product_id', 'user_id', 'quantity','type','is_confirmed','sender_id'];
}
