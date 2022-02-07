<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingSalary
 *
 * @property int $id
 * @property string $typeable_type
 * @property int $typeable_id
 * @property string $salary
 * @property string $allowance
 * @property string $bonus
 * @property string $discount
 * @property string $date
 * @property string $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereAllowance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereTypeableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereTypeableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingSalary whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingSalary extends Model
{
    protected $fillable = [
        "typeable_type",
        "typeable_id",
        "salary",
        "allowance",
        "bonus",
        "discount",
        "date",
        "total",
    ];
}
