<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingCostCenter
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $code
 * @property string|null $kind
 * @property int|null $center_id
 * @property-read \Illuminate\Database\Eloquent\Collection|AccountingCostCenter[] $children
 * @property-read int|null $children_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter whereCenterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter whereKind($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingCostCenter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingCostCenter extends Model
{
    protected $fillable = ["name", "active", "code", "center_id", "kind"];
    protected $table = "accounting_cost_centers";

    public function children()
    {
        return $this->hasMany(AccountingCostCenter::class, "center_id");
    }
}
