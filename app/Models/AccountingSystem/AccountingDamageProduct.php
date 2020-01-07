<?php

namespace App\Models\AccountingSystem;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AccountingDamageProduct extends Model
{
    protected $fillable = ['quantity','product_id','damage_id',];


    protected  $table='accounting_damages_products';


    public function product()
    {
        return $this->belongsTo(AccountingProduct::class,'product_id');
    }
    public function damage()
    {
        return $this->belongsTo(AccountingDamage::class,'damage_id');
    }
}


