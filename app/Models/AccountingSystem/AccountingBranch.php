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

    function products(){

        $stores_company= AccountingStore::where('model_id', $this->company->id)->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->pluck('id');
        $stores_branch=AccountingStore::where('model_id', $this->id)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
        $stores = array_merge(json_decode($stores_branch), json_decode($stores_company));
        $products= AccountingProductStore::whereIn('store_id',$stores)->pluck('quantity', 'product_id');
        return $products;

    }


}
