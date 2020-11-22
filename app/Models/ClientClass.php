<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClientClass extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'is_active'];
    /**
     * products relation
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'client_class_products', 'client_class_id', 'product_id')->withPivot('price');
    }
    /**
     * clients
     *
     * @return HasMany
     */
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }
    /**
     * scopeActive
     *
     * @param  Builder $builder
     * @return void
     */
    public function scopeActive(Builder $builder): void
    {

        $builder->where('is_active', 1);
    }
}
