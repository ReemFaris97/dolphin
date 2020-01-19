<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingProductDiscount extends Model
{
    protected $fillable = [ 'product_id','discount_type', 'quantity', 'gift_quantity','percent'];


}
