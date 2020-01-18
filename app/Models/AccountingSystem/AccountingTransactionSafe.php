<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingTransactionSafe extends Model
{
    protected $fillable = ['safe_form_id','safe_to_id','notes','amount'];
    protected $table='accounting_safes_transactions';


    public function getSafeFrom()
    {
        return $this->belongsTo(AccountingSafe::class,'safe_form_id');
    }
    public function getSafeTo()
    {
        return $this->belongsTo(AccountingSafe::class,'safe_to_id');
    }
}
