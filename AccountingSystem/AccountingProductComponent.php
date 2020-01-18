<?php

namespace App\Models\AccountingSystem;


use Illuminate\Database\Eloquent\Model;

class AccountingProductComponent extends Model
{
    protected  $table='accounting_product_components';
    protected $fillable = ['name','product_id','quantity','main_unit'];
}
