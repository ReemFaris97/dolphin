<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingOffer
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $package_id
 * @property string|null $quantity
 * @property string|null $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingPackage|null $package
 * @property-read \App\Models\AccountingSystem\AccountingProduct|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingOffer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingOffer extends Model
{


    protected $fillable = ['product_id','quantity','price','package_id'
    ];
    protected $table='accounting_offers';


    public function product()
    {
        return $this->belongsTo(AccountingProduct::class,'product_id');
    }
    public function package()
    {
        return $this->belongsTo(AccountingPackage::class,'package_id');
    }

}
