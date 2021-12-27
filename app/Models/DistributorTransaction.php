<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\DistributorTransaction
 *
 * @property int $id
 * @property string $sender_type
 * @property int $sender_id
 * @property string $receiver_type
 * @property int $receiver_id
 * @property string $amount
 * @property string|null $received_at
 * @property string|null $signature
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $invoice_number
 * @property-read Model|\Eloquent $receiver
 * @property-read Model|\Eloquent $sender
 * @method static Builder|DistributorTransaction newModelQuery()
 * @method static Builder|DistributorTransaction newQuery()
 * @method static \Illuminate\Database\Query\Builder|DistributorTransaction onlyTrashed()
 * @method static Builder|DistributorTransaction query()
 * @method static Builder|DistributorTransaction receiverUser($user_id)
 * @method static Builder|DistributorTransaction senderUser($user_id)
 * @method static Builder|DistributorTransaction userTransactions($user_id)
 * @method static Builder|DistributorTransaction walletOf($user_id)
 * @method static Builder|DistributorTransaction whereAmount($value)
 * @method static Builder|DistributorTransaction whereCreatedAt($value)
 * @method static Builder|DistributorTransaction whereDeletedAt($value)
 * @method static Builder|DistributorTransaction whereId($value)
 * @method static Builder|DistributorTransaction whereReceivedAt($value)
 * @method static Builder|DistributorTransaction whereReceiverId($value)
 * @method static Builder|DistributorTransaction whereReceiverType($value)
 * @method static Builder|DistributorTransaction whereSenderId($value)
 * @method static Builder|DistributorTransaction whereSenderType($value)
 * @method static Builder|DistributorTransaction whereSignature($value)
 * @method static Builder|DistributorTransaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|DistributorTransaction withTrashed()
 * @method static \Illuminate\Database\Query\Builder|DistributorTransaction withoutTrashed()
 * @mixin \Eloquent
 */
class DistributorTransaction extends Model
{
    use SoftDeletes;
    // protected $fillable = ['sender_id', 'receiver_id', 'amount','is_received','signature'];
    protected $fillable = ['sender_type', 'sender_id', 'receiver_type', 'receiver_id', 'amount', 'received_at', 'signature','confirmed_at'];

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
    public function scopeIsTransaction(Builder $builder)
    {
        $builder->whereMorphedTo('sender', User::class);
        $builder->whereMorphedTo('receiver', User::class);
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
            WHEN sender_type = 'App\\\\Models\\\\User' And sender_id=" . $user_id . "
            THEN (`amount` * -1)
            WHEN receiver_type = 'App\\\\Models\\\\User' And receiver_id=" . $user_id ." AND   confirmed_at IS NOT NULL
            THEN  `amount`
            WHEN receiver_type = 'App\\\\Models\\\\User' And receiver_id=" . $user_id ." AND sender_type='App\\\\Models\\\\Client'
            THEN  `amount`
            ELSE 0
        END
        as balance"))/* ->limit(1) */;
    }
    public function getInvoiceNumberAttribute()
    {
        return  str_pad($this->id, 6, 0, STR_PAD_LEFT);
    }

    public function amountByType($user)
    {
        if ($user->id == $this->receiver_id  && $this->receiver_type == get_class($user)) {
            return $this->amount;
        }
        return $this->amount * -1;
    }
}
