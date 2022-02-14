<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingService
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $price
 * @property string|null $type
 * @property int|null $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService newQuery()
 * @method static \Illuminate\Database\Query\Builder|AccountingService onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingService whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AccountingService withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AccountingService withoutTrashed()
 * @mixin \Eloquent
 */
class AccountingService extends Model
{
    use SoftDeletes;
    protected $fillable = ["product_id", "code", "price", "type"];
}
