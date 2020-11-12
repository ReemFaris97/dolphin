<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingClient extends Model
{


    protected $fillable = ['name','email','phone','fax','category','tax_number','commercial_registration_no','type_price','type_bills'
    ,'credit','amount','period','currency','taxes_status','is_active','balance','date','account_id'
    ];
    protected $table='accounting_clients';

    public function account()
    {
        return $this->belongsTo(AccountingAccount::class,'account_id');
    }
}
