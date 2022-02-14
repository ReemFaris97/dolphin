<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ExpenditureType
 *
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureType whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ExpenditureType extends Model
{
    protected $fillable = ["name", "is_active"];
}
