<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingBranchCategory extends Model
{
    use SoftDeletes;
    protected $fillable = ['branch_id','category_id'];
}
