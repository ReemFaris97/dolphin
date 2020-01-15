<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingPermium extends Model
{


    protected $fillable = ['client_id','amount','Benefit','total','premium_value','premium_period','premium_number'
    ];
    protected $table='accounting_packages';



    public function client()
    {
        return $this->belongsTo(AccountingClient::class,'client_id');
    }
}
