<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clause extends Model
{

    use SoftDeletes;
    protected $fillable = ['name', 'amount','user_id','default_amount','blocked_at'];

    protected $appends = ['is_active'];
    public function logs()
    {
        return $this->hasMany(ClauseLog::class);
    }

    public function getIsActiveAttribute()
    {
        $log = $this->logs()->whereDate('created_at', Carbon::today())->first();
        if ($log) return 0 ;
        return 1 ;
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
