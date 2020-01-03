<?php

namespace App\Models\AccountingSystem;


use Illuminate\Database\Eloquent\Model;

class AccountingTransaction extends Model

{
    protected  $table='accounting_transactions';
    protected $fillable = ['product_id','request_id','quantity','cost','price'];

    public function product()
    {
        return $this->belongsTo(AccountingProduct::class,'product_id');
    }
}
