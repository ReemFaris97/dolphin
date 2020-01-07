<?php

namespace App\Models\AccountingSystem;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AccountingSroreRequest extends Model
{
    protected $fillable = ['user_id','status','refused_reason','store_form','store_to',];


    protected  $table='accounting_stores_requests';

    public function getStoreFrom()
    {
        return $this->belongsTo(AccountingStore::class,'store_form');
    }
    public function getStoreTo()
    {
        return $this->belongsTo(AccountingStore::class,'store_to');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}


