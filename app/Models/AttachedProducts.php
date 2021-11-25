<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class AttachedProducts extends Model
{
    protected $fillable = ['quantity', 'price', 'product_id', 'transaction_id', 'store_id'];

    public function model()
    {
        return $this->morphTo();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->withDefault('product_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function getPriceAttribute()
    {
        if ($this->model_type==RouteTripReport::class && $this->model->is_packages) {
            return $this->attributes['price'] * $this->product->quantity_per_unit;
        }
        return $this->attributes['price'];
    }

    public function getQuantityAttribute()
    {
        if ($this->model_type==RouteTripReport::class && $this->model->is_packages) {
            return $this->attributes['quantity'] / $this->product->quantity_per_unit;
        }
        return $this->attributes['quantity'];
    }
}
