<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','store_category_id','distributor_id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }


    public function category()
    {
        return $this->belongsTo(StoreCategory::class,'store_category_id');
    }
}

