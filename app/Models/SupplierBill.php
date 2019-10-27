<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SupplierBill extends Model
{
    protected $guarded =['id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function supplier(){
        return $this->belongsTo(User::class,'supplier_id');
    }
    public function offer(){
        return $this->belongsTo(SupplierOffer::class,'offer_id');
    }

    public function total():float {
        $total = $this->amount_paid + $this->amount_rest + $this->vat;
        return $total;
    }


}
