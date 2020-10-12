<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingFiscalPeriod extends Model
{


    protected $fillable = ['year_id','name','from','to','status','type','duration'];
    protected $table='accounting_fiscal_periods';
    public function year()
    {
        return $this->belongsTo(AccountingFiscalYear::class,'year_id');
    }


}

