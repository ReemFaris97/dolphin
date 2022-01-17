<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingFundTransaction extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fund_id',
        'type',
        'amount',
        'description',
        'billable_id',
        'billable_type',
        'should_reverse',
    ];

    public function billable()
    {
        return $this->morphTo('billable');
    }
    public function transaction()
    {
        return $this->morphOne(AccountingFundTransaction::class, 'billable');
    }
}
