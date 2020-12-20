<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DailyReport extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id','cash','expenses','image','store_id'];

    public function user()
    {

        return $this->belongsTo(User::class,'user_id')->withDefault('user_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class,'store_id')->withDefault('store_id');
    }

    public function products()
    {
        return $this->morphMany(AttachedProducts::class,'model');
    }
    public function scopeFilterWithDates(Builder $builder, $from_date = null, $to_date = null): void
    {
        $builder->when($from_date, function (Builder $q) use ($from_date) {
            $q->whereDate('created_at', '>=', Carbon::parse($from_date));
        });

        $builder->when($to_date, function (Builder $q) use ($to_date) {
            $q->whereDate('created_at', '<=', Carbon::parse($to_date));
        });
    }

}
