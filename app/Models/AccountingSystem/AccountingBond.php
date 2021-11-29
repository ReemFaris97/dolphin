<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingBond
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $store_id
 * @property string|null $bond_num
 * @property string|null $date
 * @property string|null $description
 * @property string|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $total_price
 * @property int|null $store_to
 * @property int|null $store_form
 * @property-read \App\Models\AccountingSystem\AccountingStore|null $store
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereBondNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereStoreForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereStoreTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBond whereUserId($value)
 * @mixin \Eloquent
 */
class AccountingBond extends Model
{


    protected $fillable = ['user_id','store_id','bond_num','date','description','type',
    'total_price','store_to','store_form'];
    protected $table='accounting_bonds';

    public function store()
    {
        return $this->belongsTo(AccountingStore::class,'store_id');
    }


 
    public function getStoreFrom()
    {
        return $this->belongsTo(AccountingStore::class,'store_form');
    }
    public function getStoreTo()
    {
        return $this->belongsTo(AccountingStore::class,'store_to');
    }
}

