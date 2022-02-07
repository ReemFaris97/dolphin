<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * App\Models\SupplierOffer
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OfferProduct[] $offer_products
 * @property-read int|null $offer_products_count
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierOffer newQuery()
 * @method static \Illuminate\Database\Query\Builder|SupplierOffer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierOffer query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierOffer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierOffer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierOffer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierOffer whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|SupplierOffer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SupplierOffer withoutTrashed()
 * @mixin \Eloquent
 */
class SupplierOffer extends Model
{
    use SoftDeletes;
    protected $dates = ["created_at", "updated_at", "deleted_at"];
    protected $fillable = ["user_id", "status"];

    public function offer_products()
    {
        return $this->hasMany(OfferProduct::class, "supplier_offer_id");
    }

    public function totalOffer()
    {
        $prices = $this->offer_products()->pluck("price");
        $total = 0;
        foreach ($prices as $price) {
            $total += $price;
        }

        return $total;
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
