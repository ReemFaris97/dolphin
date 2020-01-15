<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingStoreKeeper extends Model
{

    protected $table='accounting_storekeepers';

    protected $fillable = [
        'name', 'email', 'password','phone','store_id',

    ];


    public function store()
    {
        return $this->belongsTo(AccountingStore::class,'store_id');
    }


}
