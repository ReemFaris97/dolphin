<?php

namespace App\Models\AccountingSystem;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AccountingUserPermission extends Model
{
    protected $fillable = ['model_id','model_type','user_id', ];
    protected $table='accounting_users_premissions';

    public function model()
    {
        return $this->morphTo();
    }

}
