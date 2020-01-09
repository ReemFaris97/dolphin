<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingBond extends Model
{


    protected $fillable = ['user_id','store_id','bond_num','date','description','type','total_price','store_to','store_form'];
    protected $table='accounting_bonds';

    public function store()
    {
        return $this->belongsTo(AccountingStore::class,'store_id');
    }


    public function getStoreFrom()
    {
        return $this->belongsTo(AccountingStore::class,'store_form');
    }
    public function getStoreTo()
    {
        return $this->belongsTo(AccountingStore::class,'store_to');
    }
}

