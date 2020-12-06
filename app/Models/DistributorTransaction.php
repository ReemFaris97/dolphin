<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class DistributorTransaction extends Model
{
    use SoftDeletes;

    // protected $fillable = ['sender_id', 'receiver_id', 'amount','is_received','signature'];
    protected $fillable = ['sender_type', 'sender_id', 'receiver_type', 'receiver_id', 'amount', 'received_at', 'signature'];

    public function sender()
    {
        return $this->morphTo('sender');
    }
    public function receiver()
    {
        return $this->morphTo('receiver');
    }
    public function scopeSenderUser(Builder $builder, $user_id)
    {
        $builder->where('sender_id', $user_id)->where('sender_type', User::class);
    }

    public function scopeReceiverUser(Builder $builder, $user_id)
    {
        $builder->where('receiver_id', $user_id)->where('receiver_type', User::class);
    }

    public function scopeUserTransactions(Builder $builder, $user_id)
    {
        $builder->where(function (Builder $builder) use ($user_id) {
            $builder->where(function ($q) use ($user_id) {
                $q->senderUser($user_id);
            });
            $builder->orWhere(function ($q) use ($user_id) {
                $q->receiverUser($user_id);
            });
        });

    }
    public function scopeWalletOf(Builder $builder, $user_id)
    {
        $builder->select('*');
        $builder->addSelect(DB::raw("CASE
            WHEN sender_type = 'App\\\\Models\\\\User' And sender_id=" . $user_id . " THEN (`amount` * -1)
            WHEN receiver_type = 'App\\\\Models\\\\User' And received_at!=" . $user_id .
            " AND   received_at IS NOT NULL THEN  `amount`
            ELSE 0
        END
        as balance"))/* ->limit(1) */;
    }
    public function getInvoiceNumberAttribute()
    {

        return  str_pad($this->id, 6, 0, STR_PAD_LEFT);
    }
}
