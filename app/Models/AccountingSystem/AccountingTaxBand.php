<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingTaxBand
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $percent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTaxBand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTaxBand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTaxBand query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTaxBand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTaxBand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTaxBand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTaxBand wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTaxBand whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingTaxBand extends Model
{
    protected $fillable = ['name','percent'];


}
