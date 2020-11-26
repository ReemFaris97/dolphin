<?php

namespace App\Models\AccountingSystem;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AccountingInventoryProduct extends Model
{
    protected $fillable = ['inventory_id','product_id','quantity','Real_quantity','status'];
    protected $table='accounting_inventory_product';


    public  function user(){
        return $this->belongsTo(User::class,'user_id');

    }
    public  function inventory(){
        return $this->belongsTo(AccountingInventory::class,'inventory_id');

    }
    public  function product(){
        return $this->belongsTo(AccountingProduct::class,'product_id');

    }
}
