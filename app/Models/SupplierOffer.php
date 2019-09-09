<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SupplierOffer extends Model
{
    use SoftDeletes;
    protected $dates=['created_at','updated_at','deleted_at'];
    protected $fillable = ['user_id'];

    public function offer_products(){
        return $this->hasMany(OfferProduct::class,'supplier_offer_id');
    }

    public function totalOffer(){
        $prices = $this->offer_products()->pluck('price');
        $total = 0;
        foreach ($prices as $price){
            $total+= $price;
        }

        return $total;
    }
}
