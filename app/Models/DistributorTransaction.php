<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class DistributorTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = ['sender_id', 'receiver_id', 'amount','is_received','signature'];

    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id');
    }
    public function scopeUserTransactions(Builder $builder, $user_id)
    {
        $this->where(function (Builder $q) use ($user_id) {
            $q->where('sender_id', $user_id);
            $q->orWhere('receiver_id', $user_id);
        });
    }
    public function scopeWalletOf(Builder $builder, $user_id)
    {
        $this->userTransactions($user_id)
            ->select(DB::raw("SUM(CASE
            WHEN sender_id = " . $user_id . " THEN (`amount` * -1)
            WHEN receiver_id = " . $user_id . " AND  is_received =1 THEN  `amount`
            ELSE 0
        END
        ) as wallet"))->limit(1);
    }
}
