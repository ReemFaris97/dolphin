<?php

namespace App\Models;

use App\Events\BankDepositConfirmed;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BankDeposit
 *
 * @property int $id
 * @property string|null $deposit_number
 * @property int|null $bank_id
 * @property int $user_id
 * @property string $amount
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $type
 * @property string $deposit_date
 * @property-read \App\Models\Bank|null $bank
 * @property-read \App\Models\User $distributor
 * @property-read \App\Models\DistributorTransaction|null $transaction
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit query()
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereDepositDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereDepositNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankDeposit whereUserId($value)
 * @mixin \Eloquent
 */
class BankDeposit extends Model
{
    protected static function booted()
    {
        self::created(function (BankDeposit $bankDeposit) {
            if ($bankDeposit->type != 'bank_transaction') {
                $bankDeposit->transaction()->create(
                    [
                        'sender_type' => User::class,
                        'sender_id' => $bankDeposit->user_id,
                        'amount' => $bankDeposit->amount,
                        'received_at' => Carbon::now(),
                        'signature' => \Str::random(5),
                    ]
                );
            }
        });

        self::updated(function (BankDeposit $bankDeposit) {
            if ( $bankDeposit->type == 'bank_transaction' && $bankDeposit->isDirty("confirmed_at") ) {
                    $bankDeposit->transaction()->create(
                        [
                            'sender_type' => User::class,
                            'sender_id' => $bankDeposit->user_id,
                            'amount' => $bankDeposit->amount,
                            'received_at' => Carbon::now(),
                            'signature' => \Str::random(5),
                        ]
                    );

                    BankDepositConfirmed::dispatch($bankDeposit);
            }

        });
    }

    protected $fillable = ['deposit_number', 'deposit_date', 'bank_id', 'user_id', 'amount', 'image', 'type',
        'from', 'to', 'confirmed_at', 'confirmed'];

    protected $dates = ['deposit_date', 'from', 'to', 'confirmed_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function distributor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaction()
    {
        return $this->morphOne(DistributorTransaction::class, 'receiver');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id')->withDefault(new Bank);
    }
}
