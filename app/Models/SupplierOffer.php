<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierOffer extends Model
{
    public function products(){
        return $this->hasMany(Product::class,'product_id');
    }

    public function offerValue(){
        return $this->products->count('price');
    }
}
