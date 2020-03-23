<?php

namespace App\Models\AccountingSystem;


use Illuminate\Database\Eloquent\Model;

class AccountingProductStore extends Model
{
    protected $fillable = ['product_id','store_id','quantity','bond_id','is_active','unit_id'];

    public  function product(){
        return $this->belongsTo(AccountingProduct::class,'product_id');

    }
    public  function store(){
        return $this->belongsTo(AccountingStore::class,'store_id');

    }
}
