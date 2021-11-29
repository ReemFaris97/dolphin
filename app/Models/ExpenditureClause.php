<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ExpenditureClause
 *
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $expenditure_type_id
 * @property int $is_active
 * @property-read \App\Models\ExpenditureType $type
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause whereExpenditureTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenditureClause whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ExpenditureClause extends Model
{
    protected $fillable = ['name','expenditure_type_id','is_active'];
    public function type()
    {
        return $this->belongsTo(ExpenditureType::class,'expenditure_type_id');
    }
}
