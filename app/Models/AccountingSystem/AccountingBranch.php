<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingBranch extends Model
{
    use SoftDeletes;

    protected $fillable = ['company_id', 'name', 'phone', 'password', 'email', 'image' ];

    public function company()
    {
        return $this->belongsTo(AccountingBranch::class);
    }
}
