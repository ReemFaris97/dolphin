<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingCenterAccount
 *
 * @property int $id
 * @property int|null $account_id
 * @property int|null $center_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingCostCenter|null $center
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCenterAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCenterAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCenterAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCenterAccount whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCenterAccount whereCenterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCenterAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCenterAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCenterAccount whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingCenterAccount extends Model
{


    protected $fillable = ['account_id','center_id'];
    protected $table='accounting_centers_accounts';


    public function center()
    {
        return $this->belongsTo(AccountingCostCenter::class,'center_id');
    }


}

