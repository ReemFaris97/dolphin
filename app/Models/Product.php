<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name', 'store_id', 'quantity_per_unit', 'min_quantity', 'max_quantity', 'price','type' ,'bar_code', 'image','expired_at'];


    public function quantities()
    {
        return $this->hasMany(ProductQuantity::class);
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function quantity():int
    {
        $count = $this->quantities()->where(['is_confirmed'=>1,'type'=>'in'])->sum('quantity');
        return $count??0;
    }
    public function images()
    {
        return $this->morphMany(Image::class,'model');
    }

    public function prices(){
        return $this->hasMany(SupplierPrice::class,'product_id');
    }

    public function authSupplierPriceId(){
        $id = SupplierPrice::where('user_id',auth()->id())->where('product_id',$this->id)->first()->id;
        return $id;
    }
    public function authSupplierPrice(){
        $price = SupplierPrice::where('user_id',auth()->id())->where('product_id',$this->id)->first()->price;
        return $price;
    }
}
