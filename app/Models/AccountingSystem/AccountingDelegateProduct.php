<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingDelegateProduct
 *
 * @property int $id
 * @property int|null $delegate_id
 * @property int|null $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegateProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegateProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegateProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegateProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegateProduct whereDelegateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegateProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegateProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegateProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingDelegateProduct extends Model
{


    protected $fillable = ['delegate_id','product_id'
    ];
    protected $table='accounting_delegate_products';




}
