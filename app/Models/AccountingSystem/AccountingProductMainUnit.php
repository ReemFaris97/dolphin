<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingProductMainUnit
 *
 * @property int $id
 * @property string|null $main_unit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductMainUnit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductMainUnit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductMainUnit query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductMainUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductMainUnit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductMainUnit whereMainUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductMainUnit whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingProductMainUnit extends Model
{
    protected $fillable = ["main_unit"];

    protected $table = "accounting_product_units";
}
