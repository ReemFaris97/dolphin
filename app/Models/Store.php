<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'store_category_id', 'distributor_id', 'is_active', 'notes'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function ProductQuantity()
    {
        return $this->hasMany(ProductQuantity::class);
    }

    public  function totalQuantities()
    {
     return  $this->ProductQuantity()->totalQuantity();
    }
    
    public function distributor()
    {
        return $this->belongsTo(User::class, 'distributor_id')
            ->withDefault(new User);
    }


    public function category()
    {
        return $this->belongsTo(StoreCategory::class, 'store_category_id');
    }

    public function scopeActive(Builder $builder): void
    {
        $builder->where('is_active', 1);
    }


}
