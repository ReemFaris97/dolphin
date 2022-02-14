<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingBranch
 *
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $phone
 * @property string $password
 * @property string|null $email
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $code
 * @property-read \App\Models\AccountingSystem\AccountingCompany $company
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingBranchFace[] $faces
 * @property-read int|null $faces_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingSafe[] $safes
 * @property-read int|null $safes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingStore[] $stores
 * @property-read int|null $stores_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch newQuery()
 * @method static \Illuminate\Database\Query\Builder|AccountingBranch onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranch whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AccountingBranch withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AccountingBranch withoutTrashed()
 * @mixin \Eloquent
 */
class AccountingBranch extends Model
{
    use SoftDeletes, HashPassword;

    protected $fillable = [
        "company_id",
        "name",
        "phone",
        "password",
        "email",
        "image",
        "code",
    ];

    public function company()
    {
        return $this->belongsTo(AccountingCompany::class, "company_id");
    }

    public function cells()
    {
        return $this->hasManyDeep(AccountingColumnCell::class, [
            AccountingBranchFace::class,
            AccountingFaceColumn::class,
        ]);
    }

    public function faces()
    {
        return $this->hasMany(AccountingBranchFace::class, "branch_id");
    }
    public function funds()
    {
        return $this->hasMany(AccountingFund::class, "branch_id");
    }

    public function stores()
    {
        return $this->morphMany(AccountingStore::class, "model");
    }

    public function safes()
    {
        return $this->morphMany(AccountingSafe::class, "model");
    }

    function products()
    {
        $stores_company = AccountingStore::where("model_id", $this->company->id)
            ->where(
                "model_type",
                "App\Models\AccountingSystem\AccountingCompany"
            )
            ->pluck("id");
        $stores_branch = AccountingStore::where("model_id", $this->id)
            ->where(
                "model_type",
                "App\Models\AccountingSystem\AccountingBranch"
            )
            ->pluck("id");
        $stores = array_merge(
            json_decode($stores_branch),
            json_decode($stores_company)
        );
        $products = AccountingProductStore::whereIn("store_id", $stores)->pluck(
            "quantity",
            "product_id"
        );
        return $products;
    }

    public function getGeneralBalances()
    {
        $generalbalances = AccountingSafe::where(
            "model_type",
            "App\Models\AccountingSystem\AccountingBranch"
        )
            ->where("model_id", $this->id)
            ->sum("amount");
        return $generalbalances;
    }
    public function getRealBalances()
    {
        $realbalances = AccountingSafe::where(
            "model_type",
            "App\Models\AccountingSystem\AccountingBranch"
        )
            ->where("model_id", $this->id)
            ->where("status", "branch")
            ->sum("amount");
        return $realbalances;
    }
}
