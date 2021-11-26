<?php

    namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use App\Notifications\CompanyResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class
AccountingCompany extends Authenticatable
{
    use Notifiable,HasFactory;
    use SoftDeletes,HashPassword;

    protected $guard = 'accounting_companies';

    protected $fillable = [
    'name', 'phone', 'password', 'email', 'image','legal_title',
    'another_title',
    'license_number',
    'street',
    'region',
    'area',
    'postal_number'];

    public function branches()
    {
        return $this->hasMany(AccountingBranch::class, 'company_id');
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



    public function products()
    {
        $stores= AccountingStore::where('model_id', $this->id)->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->pluck('id');
        $products= AccountingProductStore::whereIn('store_id', $stores)->pluck('quantity', 'product_id');
        return $products;
    }

    public function getGeneralBalances()
    {
        $generalbalances=AccountingSafe::where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->where('model_id', $this->id)->sum('amount');
        return $generalbalances;
    }
    public function getRealBalances()
    {
        $realbalances=AccountingSafe::where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->where('model_id', $this->id)->where('status', 'branch')->sum('amount');
        return $realbalances;
    }
}
