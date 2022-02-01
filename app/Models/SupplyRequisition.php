<?php

namespace App\Models;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingCompany;
use App\Models\AccountingSystem\AccountingSupplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyRequisition extends Model
{
    use HasFactory;
    protected $fillable=['accounting_company_id', 'accounting_supplier_id', 'accounting_branch_id', 'creator_id', 'approver_id', 'approved_at'];

    public function company()
    {
        return $this->belongsTo(AccountingCompany::class,'accounting_company_id');
    }

    public function supplier()
    {
        return $this->belongsTo(AccountingSupplier::class,'accounting_supplier_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'creator_id');
    }

    public function branch()
    {
        return $this->belongsTo(AccountingBranch::class,'accounting_branch_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class,'approver_id');
    }

    public function items()
    {
        return $this->hasMany(SupplyRequisitionItem::class);
    }
}
