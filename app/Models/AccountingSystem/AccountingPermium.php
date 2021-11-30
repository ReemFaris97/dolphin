<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingPermium
 *
 * @property int $id
 * @property int|null $client_id
 * @property string|null $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $status
 * @property-read \App\Models\AccountingSystem\AccountingClient|null $client
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPermium newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPermium newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPermium query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPermium whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPermium whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPermium whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPermium whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPermium whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingPermium whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingPermium extends Model
{


    protected $fillable = ['client_id','amount','Benefit','total','premium_value','premium_period','premium_number'
    ];
    protected $table='accounting_packages';



    public function client()
    {
        return $this->belongsTo(AccountingClient::class,'client_id');
    }
}
