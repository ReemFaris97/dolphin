<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingAttendance
 *
 * @property int $id
 * @property string $typeable_type
 * @property int $typeable_id
 * @property string $type
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $typeable
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance whereTypeableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance whereTypeableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAttendance whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingAttendance extends Model
{
    protected $fillable = ["typeable_type", "typeable_id", "type", "date"];
    public function typeable()
    {
        return $this->morphTo("typeable");
    }
}
