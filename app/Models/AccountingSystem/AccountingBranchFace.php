<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingBranchFace extends Model
{
    protected $fillable = ['name','branch_id'];

    public function branch()
    {
        return $this->belongsTo(AccountingBranch::class,'branch_id');
    }
}
