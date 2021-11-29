<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingProductCategory
 *
 * @property int $id
 * @property string $ar_name
 * @property string|null $en_name
 * @property string|null $ar_description
 * @property string|null $en_description
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $company_id
 * @property-read \App\Models\AccountingSystem\AccountingCompany $company
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingProduct[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory whereArDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory whereArName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory whereEnDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory whereEnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingProductCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingProductCategory extends Model
{
    protected $fillable = [ 'ar_name', 'en_name', 'ar_description', 'en_description', 'image','company_id'];

    public function company()
    {
        return $this->belongsTo(AccountingCompany::class,'company_id');
    }

    public function products()
    {
        return $this->hasMany(AccountingProduct::class,'category_id');
    }

}
