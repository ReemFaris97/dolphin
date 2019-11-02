<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingBenod extends Model
{
    protected $fillable = ['desc','sanad_num','type','clause_id','date','image'];
}
