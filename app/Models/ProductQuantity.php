<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ProductQuantity extends Model
{
    protected $fillable = ['product_id', 'user_id', 'quantity', 'type', 'is_confirmed', 'store_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->withDefault(new Product);
    }

    public function distributor()
    {
        return $this->belongsTo(User::class, 'product_id')->withDefault(new User);
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'product_id')->withDefault(new Store);
    }
}
