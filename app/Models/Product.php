<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'store_id', 'quantity_per_unit', 'min_quantity', 'max_quantity', 'price', 'type', 'bar_code', 'image', 'expired_at', 'code','tax','pirce_has_tax'];


    public function quantities()
    {
        return $this->hasMany(ProductQuantity::class);
    }
    public function stores()
    {
        return $this->belongsToMany(Store::class, 'product_quantities', 'product_id', 'store_id')->distinct();
    }

    /** @return \Illuminate\Database\Eloquent\Relations\BelongsTo  */
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

    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
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

    /**
     * @return mixed 
     * @throws \Illuminate\Contracts\Container\BindingResolutionException 
     */
    public function authSupplierProductExpireDate()
    {
        $expired_at = SupplierPrice::where('user_id', auth()->id())->where('product_id', $this->id)->first()->expired_at;
        if ($expired_at == null) return "";
        else return $expired_at;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder 
     * @param mixed $class_id 
     * @return void 
     */
    public function scopeWithClassPrice(Builder $builder, $class_id)
    {
        $builder->select("*")->addSelect(DB::raw("(select price from client_class_products where product_id=products.id and client_class_id=" . $class_id . " limit 1) as price"));
    }
    /**
     * @param mixed $user_id
     * @return float|integer
     */
    public function supplierPrice($user_id)
    {
        $price = SupplierPrice::where('user_id', $user_id)->where('product_id', $this->id)->first()->price;
        return $price;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed|null $client_id
     * @return void
     */
    public  function scopeWithClientPrice(Builder $builder, $client_id = null): void
    {
        $builder->when($client_id != null, function ($q) use ($client_id) {
            $client = Client::find($client_id);
            if ($client->client_class_id != null) {
                $q->withClassPrice($client->client_class_id);
            }
        });
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder 
     * @param mixed $store_id 
     * @return void 
     * @throws \RuntimeException 
     */
    public function ScopeOfStore(Builder $builder, $store_id): void
    {
        $builder->whereHas('stores', function (Builder $builder) use ($store_id) {
            $builder->where('store_id', $store_id);
        });
    }
}
