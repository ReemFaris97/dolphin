<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingProductionLine extends Model
{
    use HasFactory;

    protected $table = "accounting_production_lines";
    protected $fillable = ["accounting_company_id", "name", "account_id"];

    public function company()
    {
        return $this->belongsTo(
            AccountingCompany::class,
            "accounting_company_id"
        );
    }

    public function account()
    {
        return $this->belongsTo(AccountingAccount::class, "account_id");
    }
}
