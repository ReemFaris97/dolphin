<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DistributorCar
 *
 * @property int $id
 * @property string $car_name
 * @property string $car_model
 * @property int $user_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $plate_number
 * @property int $is_active
 * @property-read \App\Models\Store|null $store
 * @property-read User $user
 * @method static Builder|DistributorCar available()
 * @method static Builder|DistributorCar newModelQuery()
 * @method static Builder|DistributorCar newQuery()
 * @method static Builder|DistributorCar query()
 * @method static Builder|DistributorCar whereCarModel($value)
 * @method static Builder|DistributorCar whereCarName($value)
 * @method static Builder|DistributorCar whereCreatedAt($value)
 * @method static Builder|DistributorCar whereDeletedAt($value)
 * @method static Builder|DistributorCar whereId($value)
 * @method static Builder|DistributorCar whereIsActive($value)
 * @method static Builder|DistributorCar wherePlateNumber($value)
 * @method static Builder|DistributorCar whereUpdatedAt($value)
 * @method static Builder|DistributorCar whereUserId($value)
 * @mixin \Eloquent
 */
class DistributorCar extends Model
{
    protected $fillable = [
        "car_name",
        "car_model",
        "plate_number",
        "is_active",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id")->withDefault(
            new User()
        );
    }

    public function store()
    {
        return $this->hasOne(Store::class, "car_id");
    }

    public function scopeAvailable(Builder $builder): void
    {
        $builder->whereDoesntHave("store");
    }
}
