<?php

    namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use App\Notifications\CompanyResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AccountingCompany extends Authenticatable
{
    use Notifiable;
    use SoftDeletes,HashPassword;

    protected $guard = 'accounting_companies';
    
    protected $fillable = ['name', 'phone', 'password', 'email', 'image'];

    public function branches()
    {
        return $this->hasMany(AccountingBranch::class,'company_id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CompanyResetPassword($token));
    }



    public function shifts()
    {

       // dd("FF");
        return $this->hasManyThrough(
            'App\Models\AccountingSystem\AccountingBranchShift',
            'App\Models\AccountingSystem\AccountingBranch',
            'company_id',
            'branch_id'

        );
    }


    public function stores()
    {


        return $this->hasMany();
    }


}
