<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingMoneyClause extends Model
{
    protected $fillable = ['ar_name','en_name','type','default','en_description','ar_description'];
}
