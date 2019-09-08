<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SupplierOffer extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id'];

    public function offer_products(){
        return $this->hasMany(OfferProduct::class,'supplier_offer_id');
    }
}
