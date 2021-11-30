<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingHoliday
 *
 * @property int $id
 * @property string $name
 * @property int $duration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingHoliday newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingHoliday newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingHoliday query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingHoliday whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingHoliday whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingHoliday whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingHoliday whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingHoliday whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingHoliday extends Model
{
    protected $fillable=['name','duration'];

}
