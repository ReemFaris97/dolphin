<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingItemDiscount extends Model
{
    protected $fillable = ['type','discount','discount_type','affect_tax',];
    protected $table='accounting_items_discounts';


}
