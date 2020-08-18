<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingCustodyLog extends Model
{
    protected $fillable = ['asset_id','code','date','amount','amount_asset_after','operation_name','payment_id'];
    protected $table='accounting_custody_logs';
    public function asset()
    {
        return $this->belongsTo(AccountingAsset::class,'asset_id');
    }


}
