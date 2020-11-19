<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class AttachedProducts extends Model
{
    protected $fillable = ['quantity','price','product_id'];

    public function model()
    {
        return $this->morphTo();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
