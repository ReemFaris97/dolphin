<?php

namespace App\Models\AccountingSystem;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingUserSalary
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $title_id
 * @property string|null $salary
 * @property string|null $bouns
 * @property string|null $total_salary
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $payment_id
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary whereBouns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary whereTitleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary whereTotalSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserSalary whereUserId($value)
 * @mixin \Eloquent
 */
class AccountingUserSalary extends Model
{
    protected $fillable = ['user_id','title_id','salary','bouns','total_salary','payment_id'];

    protected $table= 'accounting_users_salary';
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
