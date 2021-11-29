<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClauseLog
 *
 * @property int $id
 * @property int $user_id
 * @property int $clause_id
 * @property float $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Clause $clause
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog whereClauseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClauseLog whereUserId($value)
 * @mixin \Eloquent
 */
class ClauseLog extends Model
{
    protected $fillable = [ 'user_id', 'clause_id', 'amount'];


    protected $casts=['amount'=>'float'];

    public function clause()
    {
        return $this->belongsTo(Clause::class, 'clause_id');

    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');

    }
}
