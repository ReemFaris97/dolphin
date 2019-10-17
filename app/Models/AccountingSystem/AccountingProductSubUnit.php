<?php

namespace App\Models\AccountingSystem;


use Illuminate\Database\Eloquent\Model;

class AccountingProductSubUnit extends Model
{
    protected $fillable = ['name','product_id','par_code','main_unit_present','selling_price','purchasing_price'];
}
