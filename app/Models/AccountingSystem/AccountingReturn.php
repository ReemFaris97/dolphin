<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingReturn extends Model
{


    protected $fillable = ['user_id','sale_id','item_id','quantity','price','session_id'];
    protected $table='accounting_returns';
    public function store()
    {
        return $this->belongsTo(AccountingStore::class,'store_id');
    }

    public function session()
    {
        return $this->belongsTo(AccountingSession::class,'session_id');
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

