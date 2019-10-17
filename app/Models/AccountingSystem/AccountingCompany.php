<?php

    namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingCompany extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name', 'phone', 'password', 'email', 'image'];

    public function branches()
    {
        return $this->hasMany(AccountingBranch::class,'company_id');
    }

}
