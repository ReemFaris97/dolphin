<?php

namespace App\Models;

use App\Models\AccountingSystem\AccountingProductBarcode;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingSetting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property int|null $store_id
 * @property string $quantity_per_unit
 * @property string|null $min_quantity
 * @property string|null $max_quantity
 * @property string $price
 * @property string $type
 * @property string|null $bar_code
 * @property string|null $image
 * @property string|null $expired_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $code
 * @property-read \Illuminate\Database\Eloquent\Collection|AccountingProductBarcode[] $barcodes
 * @property-read int|null $barcodes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClientClass[] $client_classes
 * @property-read int|null $client_classes_count
 * @property-read mixed $net_price
 * @property-read mixed $tax_amount
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SupplierPrice[] $prices
 * @property-read int|null $prices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductQuantity[] $quantities
 * @property-read int|null $quantities_count
 * @property-read \App\Models\Store|null $store
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Store[] $stores
 * @property-read int|null $stores_count
 * @property-read \Illuminate\Database\Eloquent\Collection|AccountingProductSubUnit[] $sub_units
 * @property-read int|null $sub_units_count
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static \Illuminate\Database\Query\Builder|Product onlyTrashed()
 * @method static Builder|Product query()
 * @method static Builder|Product whereBarCode($value)
 * @method static Builder|Product whereCode($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDeletedAt($value)
 * @method static Builder|Product whereExpiredAt($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereImage($value)
 * @method static Builder|Product whereMaxQuantity($value)
 * @method static Builder|Product whereMinQuantity($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereQuantityPerUnit($value)
 * @method static Builder|Product whereStoreId($value)
 * @method static Builder|Product whereType($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @method static Builder|Product withClassPrice($class_id)
 * @method static Builder|Product withClientPrice($client_id = null)
 * @method static \Illuminate\Database\Query\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Product withoutTrashed()
 * @mixin \Eloquent
 */
class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "name",
        "store_id",
        "quantity_per_unit",
        "min_quantity",
        "max_quantity",
        "price",
        "type",
        "bar_code",
        "image",
        "expired_at",
        "code",
        "tax",
        "pirce_has_tax",
    ];

    public function quantities()
    {
        return $this->hasMany(ProductQuantity::class);
    }
    public function stores()
    {
        return $this->belongsToMany(
            Store::class,
            "product_quantities",
            "product_id",
            "store_id"
        )->distinct();
    }

    /** @return \Illuminate\Database\Eloquent\Relations\BelongsTo  */
    public function store()
    {
        return $this->belongsTo(Store::class)->withDefault(Store::class);
    }

    public function client_classes()
    {
        return $this->belongsToMany(
            ClientClass::class,
            "client_class_products",
            "product_id",
            "client_class_id"
        )->withPivot("price");
    }
    public function quantity(): int
    {
        $count = $this->quantities()
            ->where(["is_confirmed" => 1, "type" => "in"])
            ->sum("quantity");
        return $count ?? 0;
    }
    public function barcodes()
    {
        return $this->hasMany(AccountingProductBarcode::class);
    }
    public function sub_units()
    {
        return $this->hasMany(AccountingProductSubUnit::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, "model");
    }

    public function prices()
    {
        return $this->hasMany(SupplierPrice::class, "product_id");
    }

    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function authSupplierPriceId()
    {
        $id = SupplierPrice::where("user_id", auth()->id())
            ->where("product_id", $this->id)
            ->first()->id;
        return $id;
    }

    public function authSupplierPrice()
    {
        $price = SupplierPrice::where("user_id", auth()->id())
            ->where("product_id", $this->id)
            ->first()->price;
        return $price;
    }

    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function authSupplierProductExpireDate()
    {
        $expired_at = SupplierPrice::where("user_id", auth()->id())
            ->where("product_id", $this->id)
            ->first()->expired_at;
        if ($expired_at == null) {
            return "";
        } else {
            return $expired_at;
        }
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed $class_id
     * @return void
     */
    public function scopeWithClassPrice(Builder $builder, $class_id)
    {
        $builder
            ->select("*")
            ->addSelect(
                DB::raw(
                    "(select price from client_class_products where product_id=products.id and client_class_id=" .
                        $class_id .
                        " limit 1) as price"
                )
            );
    }
    /**
     * @param mixed $user_id
     * @return float|integer
     */
    public function supplierPrice($user_id)
    {
        $price = SupplierPrice::where("user_id", $user_id)
            ->where("product_id", $this->id)
            ->first()->price;
        return $price;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed|null $client_id
     * @return void
     */
    public function scopeWithClientPrice(
        Builder $builder,
        $client_id = null
    ): void {
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
        $builder->whereHas("stores", function (Builder $builder) use (
            $store_id
        ) {
            $builder->where("store_id", $store_id);
        });
    }

    public function getTaxAmountAttribute()
    {
        $tax = AccountingSetting::where("name", "general_taxs")->first();

        return $this->price * ($tax->value / 100);
    }

    public function getNetPriceAttribute()
    {
    }
}
