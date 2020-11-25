<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SupplierTransaction extends Model
{
    protected $guarded = ['id'];

    public function supplier(){
        return $this->belongsTo(User::class,'supplier_id');
    }



}
