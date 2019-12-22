<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingProductCategory extends Model
{
    protected $fillable = [ 'ar_name', 'en_name', 'ar_description', 'en_description', 'image','company_id'];

    public function company()
    {
        return $this->belongsTo(AccountingCompany::class,'company_id');
    }

    public function products()
    {
        return $this->hasMany(AccountingProduct::class,'category_id');
    }

}
