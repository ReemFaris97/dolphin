<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingBenod
 *
 * @property int $id
 * @property string $ar_name
 * @property string|null $en_name
 * @property string|null $en_description
 * @property string|null $ar_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod whereArDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod whereEnDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBenod whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingBenod extends Model
{
    protected $fillable = ['ar_name','en_name','en_description','ar_description',];


    
}
