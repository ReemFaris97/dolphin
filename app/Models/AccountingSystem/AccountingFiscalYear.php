<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingFiscalYear extends Model
{


    protected $fillable = ['name','from','to','status'];
    protected $table='accounting_fiscal_years';
    public function periods()
    {
        return $this->hasMany(AccountingFiscalPeriod::class,'year_id');
    }


}

