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

    // protected $fillable = ['sender_id', 'receiver_id', 'amount','is_received','signature'];
    protected $fillable = ['sender_type', 'sender_id', 'user_id', 'amount', 'type', 'is_received', 'signature',];

    public function sender()
    {
        return $this->morphTo('sender');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }
    public function scopeUserTransactions(Builder $builder, $user_id)
    {
        $builder->where('user_id', $user_id);

    }
    public function scopeWalletOf(Builder $builder, $user_id)
    {
        $this->userTransactions($user_id)
            ->select(DB::raw("SUM(CASE
            WHEN type = 'out' THEN (`amount` * -1)
            WHEN type = 'in' AND  is_received =1 THEN  `amount`
            ELSE 0
        END
        ) as wallet"))->limit(1);
    }
}
