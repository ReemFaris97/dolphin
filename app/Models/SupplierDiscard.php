<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SupplierDiscard extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function supplier(){
        return $this->belongsTo(User::class,'supplier_id');
    }

    public function discard_products(){
        return $this->hasMany(DiscardProduct::class,'discard_id');
    }

    public function total():int {
        $total = $this->discard_products()->where('type','discard')->sum('price');
        return $total;
    }
}
