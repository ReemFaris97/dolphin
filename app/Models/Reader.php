<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Reader
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $image
 * @property int $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|Reader newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reader newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reader query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reader whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reader whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reader whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reader whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reader whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reader whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Reader extends Model
{
    protected $fillable = [ 'name','image','is_active'];

}
