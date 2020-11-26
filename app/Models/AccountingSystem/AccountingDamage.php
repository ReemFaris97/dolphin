<?php

namespace App\Models\AccountingSystem;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AccountingDamage extends Model
{
    protected $fillable = ['user_id','store_id'];

    protected  $table='accounting_damages';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function store()
    {
        return $this->belongsTo(AccountingStore::class,'store_id');
    }
    public function productCount()
    {
        return $this->hasMany(AccountingDamageProduct::class,'damage_id')->sum('quantity');
    }
    public function products()
    {
        return $this->hasMany(AccountingDamageProduct::class,'damage_id');
    }


}


