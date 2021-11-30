<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingReturn
 *
 * @property int $id
 * @property int|null $sale_id
 * @property string|null $discount
 * @property string|null $total
 * @property string|null $bill_num
 * @property string|null $totalTaxs
 * @property string|null $discount_type
 * @property string|null $payment
 * @property int|null $session_id
 * @property int|null $user_id
 * @property int|null $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $branch_id
 * @property string|null $amount
 * @property-read \App\Models\AccountingSystem\AccountingBranch|null $branch
 * @property-read \App\Models\AccountingSystem\AccountingClient|null $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingReturnSaleItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\AccountingSystem\AccountingSession|null $session
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereBillNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereTotalTaxs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingReturn whereUserId($value)
 * @mixin \Eloquent
 */
class AccountingReturn extends Model
{


    protected $fillable = ['user_id','sale_id','discount','total','bill_num','session_id','totalTaxs','discount_type','payment'
     , 'amount' ,'branch_id','client_id'];
    protected $table='accounting_sales_returns';
    public function branch()
    {
        return $this->belongsTo(AccountingBranch::class,'branch_id');
    }

    public function session()
    {
        return $this->belongsTo(AccountingSession::class,'session_id');
    }


    public function client()
    {
        return $this->belongsTo(AccountingClient::class,'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function items()
    {
        return $this->hasMany(AccountingReturnSaleItem::class,'sale_return_id');
    }

}

