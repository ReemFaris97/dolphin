<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingBranch extends Model
{
    use SoftDeletes,HashPassword;



    protected $fillable = ['company_id', 'name', 'phone', 'password', 'email', 'image' ,'code'];

    public function company()
    {
        return $this->belongsTo(AccountingCompany::class,'company_id');
    }

    public function cells() {
        return $this->hasManyDeep(AccountingColumnCell::class, [AccountingBranchFace::class, AccountingFaceColumn::class]);
    }

    public function faces()
    {

        return $this->hasMany(AccountingBranchFace::class,'branch_id');
    }

    public function stores()
    {
        return $this->morphMany(AccountingStore::class, 'model');
    }

    public function safes()
    {
        return $this->morphMany(AccountingSafe::class, 'model');
    }

}
