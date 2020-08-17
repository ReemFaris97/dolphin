<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingAssetDamageLog extends Model
{
    protected $fillable = ['asset_id','code','date','amount','amount_asset_after'];
    protected $table='accounting_asset_damaged_logs';
    public function asset()
    {
        return $this->belongsTo(AccountingAsset::class,'asset_id');
    }

}
