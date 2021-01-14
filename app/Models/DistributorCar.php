<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class DistributorCar extends Model
{
    protected $fillable = ['car_name', 'car_model', 'plate_number', 'is_active'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault(new User);
    }

    public function store()
    {
        return $this->hasOne(Store::class, 'car_id');
    }

    public function scopeAvailable(Builder $builder): void
    {
        $builder->whereDoesntHave('store');
    }
}
