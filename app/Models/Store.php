<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Store
 *
 * @property int $id
 * @property array $name
 * @property int|null $store_category_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $distributor_id
 * @property string|null $notes
 * @property int $is_active
 * @property int $for_distributor
 * @property int|null $has_car
 * @property int|null $car_id
 * @property int $for_damaged
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductQuantity[] $ProductQuantity
 * @property-read int|null $product_quantity_count
 * @property-read \App\Models\DistributorCar|null $car
 * @property-read \App\Models\StoreCategory|null $category
 * @property-read User|null $distributor
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static Builder|Store active()
 * @method static Builder|Store newModelQuery()
 * @method static Builder|Store newQuery()
 * @method static Builder|Store ofDistributor($distributor_id)
 * @method static \Illuminate\Database\Query\Builder|Store onlyTrashed()
 * @method static Builder|Store query()
 * @method static Builder|Store whereCarId($value)
 * @method static Builder|Store whereCreatedAt($value)
 * @method static Builder|Store whereDeletedAt($value)
 * @method static Builder|Store whereDistributorId($value)
 * @method static Builder|Store whereForDamaged($value)
 * @method static Builder|Store whereForDistributor($value)
 * @method static Builder|Store whereHasCar($value)
 * @method static Builder|Store whereId($value)
 * @method static Builder|Store whereIsActive($value)
 * @method static Builder|Store whereName($value)
 * @method static Builder|Store whereNotes($value)
 * @method static Builder|Store whereStoreCategoryId($value)
 * @method static Builder|Store whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Store withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Store withoutTrashed()
 * @mixin \Eloquent
 */
class Store extends Model
{
    use SoftDeletes, HasTranslations;

    public $translatable = ["name"];

    protected $fillable = [
        "name",
        "store_category_id",
        "distributor_id",
        "is_active",
        "notes",
        "for_distributor",
        "has_car",
        "car_id",
        "for_damaged",
    ];

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            "product_quantities",
            "store_id",
            "product_id"
        )->distinct();
    }

    public function ProductQuantity()
    {
        return $this->hasMany(ProductQuantity::class);
    }

    public function totalQuantities()
    {
        return $this->ProductQuantity()->totalQuantity();
    }

    public function car()
    {
        return $this->belongsTo(DistributorCar::class, "car_id");
    }

    public function distributor()
    {
        return $this->belongsTo(User::class, "distributor_id")->withDefault(
            new User()
        );
    }

    public function category()
    {
        return $this->belongsTo(
            StoreCategory::class,
            "store_category_id"
        )->withDefault(new StoreCategory());
    }

    public function scopeActive(Builder $builder): void
    {
        $builder->where("is_active", 1);
    }

    public function scopeOfDistributor(Builder $builder, $distributor_id): void
    {
        $builder->where("for_distributor", 1);
        $builder->where("distributor_id", $distributor_id);
    }
}
