<?php

namespace App\Models\AccountingSystem;


use Illuminate\Database\Eloquent\Model;

class AccountingProductSubUnit extends Model
{
    protected  $table='accounting_products_subUnits';
    protected $fillable = ['name','product_id','bar_code','main_unit_present','selling_price','purchasing_price','quantity'];
}
