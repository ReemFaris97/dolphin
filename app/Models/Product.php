<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name', 'store_id', 'quantity_per_unit', 'min_quantity', 'max_quantity', 'price', 'bar_code', 'image','expired_at'];


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
}
