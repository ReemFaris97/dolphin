<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ChargeLog extends Model
{
    protected $fillable =['worker_id', 'type','charge_id','previous_worker_id'];



    public function images()
    {
        return $this->morphMany(Image::class,'model');
    }

    public function charge()
    {
        return $this->belongsTo(Charge::class,'charge_id');
    }

    public function worker()
    {
        return $this->belongsTo(User::class,'worker_id');
    }

    public function previousWorker()
    {
        return $this->belongsTo(User::class,'previous_worker_id');
    }
}
