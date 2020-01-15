<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingBranchShift extends Model
{
    use SoftDeletes;

    protected $fillable=  [ 'branch_id', 'name', 'from', 'to'];

    public function branch()
    {
        return $this->belongsTo(AccountingBranch::class,'branch_id');
    }
}
