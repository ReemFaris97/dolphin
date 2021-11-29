<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingStore
 *
 * @property int $id
 * @property string $ar_name
 * @property string|null $en_name
 * @property string|null $address
 * @property string|null $image
 * @property string $model_type
 * @property int $model_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $code
 * @property string|null $lat
 * @property string|null $lng
 * @property string|null $width
 * @property int $status
 * @property string|null $cost
 * @property string|null $from
 * @property string|null $to
 * @property int $type
 * @property int|null $basic_store_id
 * @property int $is_active
 * @property int|null $user_id
 * @property int|null $account_id
 * @property-read AccountingStore|null $basic
 * @property-read Model|\Eloquent $model
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingProduct[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore newQuery()
 * @method static \Illuminate\Database\Query\Builder|AccountingStore onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereBasicStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingStore whereWidth($value)
 * @method static \Illuminate\Database\Query\Builder|AccountingStore withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AccountingStore withoutTrashed()
 * @mixin \Eloquent
 */
class AccountingStore extends Model
{
    use SoftDeletes;

    protected $fillable =['ar_name', 'en_name', 'address', 'image','model_id','model_type','user_id',
        'code','width','lat','lng','type','status','cost','form','to','basic_store_id','is_active','account_id'];

    public function model()
    {
        return $this->morphTo();
    }

    public function basic()
    {
        return $this->belongsTo(AccountingStore::class, 'basic_store_id');
    }

    public function products()
    {
        return $this->belongsToMany(AccountingProduct::class, 'accounting_product_stores','store_id','product_id');
    }




}
