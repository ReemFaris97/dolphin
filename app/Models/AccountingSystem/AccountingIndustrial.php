<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingIndustrial
 *
 * @property int $id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingIndustrial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingIndustrial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingIndustrial query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingIndustrial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingIndustrial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingIndustrial whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingIndustrial whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingIndustrial extends Model
{
    protected $fillable = ["name"];
    protected $table = "accounting_product_industrials";
}
