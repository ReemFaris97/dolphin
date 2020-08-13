<?php

namespace App\Models\AccountingSystem;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AccountingUserSalary extends Model
{
    protected $fillable = ['user_id','title_id','salary','bouns','total_salary'];

    protected $table= 'accounting_users_salary';
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
