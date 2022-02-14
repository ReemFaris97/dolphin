<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ReasonRefuseDistributor
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ReasonRefuseDistributor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReasonRefuseDistributor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReasonRefuseDistributor query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReasonRefuseDistributor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReasonRefuseDistributor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReasonRefuseDistributor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReasonRefuseDistributor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ReasonRefuseDistributor extends Model
{
    protected $fillable = ["name"];
}
