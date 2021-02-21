<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingAttentance extends Model
{
    protected $fillable=['typeable_type','typeable_id','type','date'];
}
