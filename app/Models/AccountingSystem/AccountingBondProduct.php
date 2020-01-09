<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingBondProduct extends Model
{


    protected $fillable = ['quantity','product_id','bond_id','price'];
    protected $table='accounting_bond_products';
    public function product()
    {
        return $this->belongsTo(AccountingProduct::class,'product_id');
    }



}
