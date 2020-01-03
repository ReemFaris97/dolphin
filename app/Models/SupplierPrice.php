<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierPrice extends Model
{
    protected $fillable =['user_id','product_id','price','expired_at'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
