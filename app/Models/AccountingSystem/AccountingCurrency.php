<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingCurrency
 *
 * @property int $id
 * @property string|null $ar_name
 * @property string|null $en_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCurrency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCurrency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCurrency query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCurrency whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCurrency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCurrency whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCurrency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCurrency whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingCurrency extends Model
{


    protected $fillable = ['ar_name','en_name',
 ];
    protected $table='accounting_currencies';


}

