<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscardProduct extends Model
{
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function discard()
    {
        return $this->belongsTo(SupplierDiscard::class, 'discard_id');
    }
}
