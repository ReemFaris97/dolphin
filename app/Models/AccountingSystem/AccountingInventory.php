<?php

namespace App\Models\AccountingSystem;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AccountingInventory extends Model
{
    protected $fillable = ['date','user_id','store_id','bond_num','description'];


    public  function user(){
        return $this->belongsTo(User::class,'user_id');

    }
    public  function store(){
        return $this->belongsTo(AccountingStore::class,'store_id');

    }

}
