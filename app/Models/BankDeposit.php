<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDeposit extends Model
{
    protected $fillable = ['deposit_number', 'bank_id', 'user_id', 'amount', 'image'];

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
