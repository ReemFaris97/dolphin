<?php

namespace App\Models\AccountingSystem;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AccountingTransactionSafe extends Model
{
    protected $fillable = ['safe_form_id','safe_to_id','notes','amount','user_id','type'];
    protected $table='accounting_safes_transactions';


    public function getSafeFrom()
    {
        return $this->belongsTo(AccountingSafe::class,'safe_form_id');
    }
    public function getSafeTo()
    {
        return $this->belongsTo(AccountingSafe::class,'safe_to_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
