<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingBranchShift
 *
 * @property int $id
 * @property int $branch_id
 * @property string $name
 * @property string $from
 * @property string $to
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingBranch $branch
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift newQuery()
 * @method static \Illuminate\Database\Query\Builder|AccountingBranchShift onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchShift whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AccountingBranchShift withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AccountingBranchShift withoutTrashed()
 * @mixin \Eloquent
 */
class AccountingBranchShift extends Model
{
    use SoftDeletes;

    protected $fillable=  [ 'branch_id', 'name', 'from', 'to'];

    public function branch()
    {
        return $this->belongsTo(AccountingBranch::class,'branch_id');
    }
}
