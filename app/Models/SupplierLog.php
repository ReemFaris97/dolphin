<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SupplierLog extends Model
{
    protected $fillable =['user_id','log'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
