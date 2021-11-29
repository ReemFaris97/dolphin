<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingAllowance
 *
 * @property int $id
 * @property string $name
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAllowance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAllowance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAllowance query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAllowance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAllowance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAllowance whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAllowance whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingAllowance whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingAllowance extends Model
{
    protected $fillable=['name','notes'];
}
