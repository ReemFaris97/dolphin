<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingStore extends Model
{
    use SoftDeletes;

    protected $fillable =['ar_name', 'en_name', 'address', 'image','model_id','model_type','user_id',
        'code','width','lat','lng','type','status','cost','form','to','basic_store_id','is_active'];

    public function model()
    {
        return $this->morphTo();
    }

    public function basic()
    {
        return $this->belongsTo(AccountingStore::class, 'basic_store_id');
    }




}
