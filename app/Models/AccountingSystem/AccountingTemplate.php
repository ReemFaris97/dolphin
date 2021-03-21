<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingTemplate extends Model
{
    protected $fillable = ['first_account_id', 'second_account_id', 'result','operation','template_id','report_no'];
    protected $table = 'accounting_templates';

    public function first_account()
    {
        return $this->belongsTo(AccountingAccount::class,'first_account_id');
    }
    public function second_account()
    {
        return $this->belongsTo(AccountingAccount::class,'second_account_id');
    }
    public function template()
    {
        return $this->belongsTo(AccountingTemplate::class,'template_id');
    }
}

