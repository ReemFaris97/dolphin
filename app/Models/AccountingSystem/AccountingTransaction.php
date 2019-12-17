<?php

namespace App\Models\AccountingSystem;


use Illuminate\Database\Eloquent\Model;

class AccountingTransaction extends Model

{
    protected  $table='accounting_transactions';
    protected $fillable = ['product_id','store_form','store_to','quantity'];
}
