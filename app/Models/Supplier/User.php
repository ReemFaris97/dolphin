<?php

namespace App\Models\Supplier;

use App\Models\AccountingSystem\AccountingCompany;
use App\Models\AccountingSystem\AccountingSupplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = "suppliers_users";

    protected $fillable = [
        "name",
        "company_name",
        "commercial_number",
        "phone",
        "email",
        "password",
        "commercial_image",
        "licence_image",
        "image",
        "address",
        "lat",
        "lng",
        "landline",
        "credit_limit",
        "permissions",
        "credit_date",
        "reset_at",
        "reset_code",
        "parent_id",
        "fcm_token_android",
        "fcm_token_ios",
        "supplier_id",
        "tax_number",
    ];
    protected $images = ["commercial_image", "licence_image", "image"];

    protected $casts = ["permissions" => "array"];
    public function setPasswordAttribute($value)
    {
        $this->attributes["password"] = bcrypt($value);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function parent()
    {
        return $this->belongsTo(User::class, "parent_id");
    }

    public function children()
    {
        return $this->hasMany(User::class, "parent_id");
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

    public function getImageAttribute($value)
    {
        if ($value) {
            return getimg($value);
        } else {
            return asset("placeholders/logo.png");
        }
    }

    public function setImageAttribute($value)
    {
        if (is_file($value)) {
            $this->attributes["image"] = Fileuploader($value);
        } else {
            $this->attributes["image"] = $value;
        }
    }

    public function getCommercialImageAttribute($value)
    {
        if ($value) {
            return getimg($value);
        } else {
            return asset("placeholders/logo.png");
        }
    }

    public function setCommercialImageAttribute($value)
    {
        if (is_file($value)) {
            $this->attributes["commercial_image"] = Fileuploader($value);
        } else {
            $this->attributes["commercial_image"] = $value;
        }
    }
    public function getLicenceImageAttribute($value)
    {
        if ($value) {
            return getimg($value);
        } else {
            return asset("placeholders/logo.png");
        }
    }

    public function setLicenceImageAttribute($value)
    {
        if (is_file($value)) {
            $this->attributes["licence_image"] = Fileuploader($value);
        } else {
            $this->attributes["licence_image"] = $value;
        }
    }
    public function companies()
    {
        return $this->belongsToMany(
            AccountingCompany::class,
            UserCompany::class,
            "user_id"
        );
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
        return $this->belongsTo(AccountingSupplier::class, "supplier_id");
    }

    public function banks()
    {
        return $this->supplier->banks();
    }

    public function invoices()
    {
        return $this->hasManyThrough(Invoice::class, AccountingSupplier::class);
    }
}
