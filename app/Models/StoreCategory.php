<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\StoreCategory
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $blocked_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Store[] $stores
 * @property-read int|null $stores_count
 * @method static \Illuminate\Database\Eloquent\Builder|StoreCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|StoreCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreCategory whereBlockedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|StoreCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StoreCategory withoutTrashed()
 * @mixin \Eloquent
 */
class StoreCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','blocked_at'];

    public function stores(){
        return $this->hasMany(Store::class);
    }
}
