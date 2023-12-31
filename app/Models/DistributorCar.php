<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class DistributorCar extends Model
{
    protected $fillable = ['car_name', 'car_model', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
