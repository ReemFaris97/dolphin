<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DailyReport extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id','cash','expenses','image'];

    public function user()
    {

        return $this->belongsTo(User::class,'user_id')->withDefault('user_id');
    }

    public function products()
    {
        return $this->morphMany(AttachedProducts::class,'model');
    }
}
