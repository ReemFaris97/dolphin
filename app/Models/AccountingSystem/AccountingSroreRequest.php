<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingSroreRequest extends Model
{
    protected $fillable = ['user_id','status','refused_reason','store_form','store_to',];


    protected  $table='accounting_stores_requests';

    public function store()
    {
        return $this->belongsTo(AccountingStore::class,'store_form');
    }
}
