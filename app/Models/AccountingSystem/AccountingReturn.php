<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingReturn extends Model
{


    protected $fillable = ['user_id','sale_id','discount','total','bill_num','session_id','totalTaxs','discount_type','payment'
     , 'amount' ,'branch_id','client_id'];
    protected $table='accounting_sales_returns';
    public function branch()
    {
        return $this->belongsTo(AccountingBranch::class,'branch_id');
    }

    public function session()
    {
        return $this->belongsTo(AccountingSession::class,'session_id');
    }


    public function client()
    {
        return $this->belongsTo(AccountingClient::class,'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function items()
    {
        return $this->hasMany(AccountingReturnSaleItem::class,'sale_return_id');
    }

}

