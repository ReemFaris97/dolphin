<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingAsset extends Model
{


    protected $fillable = ['name','currency_id','purchase_price','purchase_date','payment_id','account_id','damage_start_date','damage_end_date','damage_type','damage_period'
,'damage_period_type','damage_price','type'
];
    protected $table='accounting_assets';


    public function currency()
    {
        return $this->belongsTo(AccountingCurrency::class,'currency_id');
    }

    public function account()
    {
        return $this->belongsTo(AccountingAccount::class,'account_id');
    }
    public function AssetLogs()
    {

          return $this->hasMany(AccountingAssetDamageLog::class,'asset_id');

    }

    public function custodyLogs()
    {

          return $this->hasMany(AccountingCustodyLog::class,'asset_id');

    }
}

