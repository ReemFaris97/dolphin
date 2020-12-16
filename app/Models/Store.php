<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Store extends Model
{
    use SoftDeletes, HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'store_category_id', 'distributor_id', 'is_active', 'notes', 'for_distributor','has_car','car_id'];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_quantities', 'store_id', 'product_id')->distinct();
    }
    public function ProductQuantity()
    {
        return $this->hasMany(ProductQuantity::class);
    }

    public function totalQuantities()
    {
        return $this->ProductQuantity()->totalQuantity();
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
    public function scopeOfDistributor(Builder $builder, $distributor_id): void
    {
        $builder->where('for_distributor', 1);
        $builder->where('distributor_id', $distributor_id);
    }


}
