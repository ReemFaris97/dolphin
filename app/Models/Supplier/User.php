<?php

namespace App\Models\Supplier;

use App\Models\AccountingSystem\AccountingCompany;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Traits\HasImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    protected $table = 'suppliers_users';
    use HasFactory, HasImages;

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $fillable = ['name', 'company_name', 'commercial_number', 'phone', 'email', 'password', 'commercial_image', 'licence_image', 'image',
        'address', 'lat', 'lng', 'landline', 'credit_limit', 'credit_date', 'parent_id', 'fcm_token_android', 'fcm_token_ios','supplier_id'];
    protected $images = ['commercial_image', 'licence_image', 'image'];

    public function companies()
    {
        return $this->belongsToMany(AccountingCompany::class, UserCompany::class,'user_id');
    }

    public function accountingCompannies()
    {
        return $this->hasMany(UserCompany::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(AccountingSupplier::class,'supplier_id');
    }

    public function invoices()
    {
        return $this->hasManyThrough(Invoice::class, AccountingSupplier::class,'');
    }

}
