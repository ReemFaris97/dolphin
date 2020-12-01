<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'store_id', 'quantity_per_unit', 'min_quantity', 'max_quantity', 'price', 'type', 'bar_code', 'image', 'expired_at', 'code','tax','pirce_has_tax'];


    public function quantities()
    {
        return $this->hasMany(ProductQuantity::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class)->withDefault(Store::class);
    }

    public function client_classes()
    {
        return $this->belongsToMany(ClientClass::class, 'client_class_products',  'product_id', 'client_class_id')->withPivot('price');
    }
    public function quantity(): int
    {
        $count = $this->quantities()->where(['is_confirmed' => 1, 'type' => 'in'])->sum('quantity');
        return $count ?? 0;
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }

    public function prices()
    {
        return $this->hasMany(SupplierPrice::class, 'product_id');
    }

    public function authSupplierPriceId()
    {
        $id = SupplierPrice::where('user_id', auth()->id())->where('product_id', $this->id)->first()->id;
        return $id;
    }

    public function authSupplierPrice()
    {
        $price = SupplierPrice::where('user_id', auth()->id())->where('product_id', $this->id)->first()->price;
        return $price;
    }

    public function authSupplierProductExpireDate()
    {
        $expired_at = SupplierPrice::where('user_id', auth()->id())->where('product_id', $this->id)->first()->expired_at;
        if ($expired_at == null) return "";
        else return $expired_at;
    }

    public function supplierPrice($user_id)
    {
        $price = SupplierPrice::where('user_id', $user_id)->where('product_id', $this->id)->first()->price;
        return $price;
    }

}
