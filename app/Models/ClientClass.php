<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\ClientClass
 *
 * @property int $id
 * @property string $name
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static Builder|ClientClass active()
 * @method static Builder|ClientClass newModelQuery()
 * @method static Builder|ClientClass newQuery()
 * @method static Builder|ClientClass query()
 * @method static Builder|ClientClass whereCreatedAt($value)
 * @method static Builder|ClientClass whereId($value)
 * @method static Builder|ClientClass whereIsActive($value)
 * @method static Builder|ClientClass whereName($value)
 * @method static Builder|ClientClass whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ClientClass extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["name", "is_active"];
    /**
     * products relation
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            "client_class_products",
            "client_class_id",
            "product_id"
        )->withPivot("price");
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
        $builder->where("is_active", 1);
    }
}
