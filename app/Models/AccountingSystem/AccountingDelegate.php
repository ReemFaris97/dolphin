<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingDelegate
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $commission
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingDelegate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingDelegate extends Model
{


    protected $fillable = ['name','email','phone','commission'
    ];
    protected $table='accounting_delegates';




}
