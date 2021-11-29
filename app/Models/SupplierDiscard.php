<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\SupplierDiscard
 *
 * @property int $id
 * @property int $user_id
 * @property int $supplier_id
 * @property string $reason
 * @property string $return_type
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DiscardProduct[] $discard_products
 * @property-read int|null $discard_products_count
 * @property-read User $supplier
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard newQuery()
 * @method static \Illuminate\Database\Query\Builder|SupplierDiscard onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard whereReturnType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierDiscard whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|SupplierDiscard withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SupplierDiscard withoutTrashed()
 * @mixin \Eloquent
 */
class SupplierDiscard extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function supplier(){
        return $this->belongsTo(User::class,'supplier_id');
    }

    public function discard_products(){
        return $this->hasMany(DiscardProduct::class,'discard_id');
    }

    public function total():int {
        $total = $this->discard_products()->where('type','discard')->sum('price');
        return $total;
    }
}
