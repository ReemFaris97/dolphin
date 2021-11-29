<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingBonusDiscount
 *
 * @property int $id
 * @property string $typeable_type
 * @property int $typeable_id
 * @property string $type
 * @property string $date
 * @property string $value
 * @property string|null $notes
 * @property string|null $reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $typeable
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereTypeableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereTypeableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBonusDiscount whereValue($value)
 * @mixin \Eloquent
 */
class AccountingBonusDiscount extends Model
{
    protected $fillable = ['typeable_id','typeable_type', 'type', 'date', 'value', 'notes','reason'];

    public function typeable(){
        return $this->morphTo('typeable');
    }
}
