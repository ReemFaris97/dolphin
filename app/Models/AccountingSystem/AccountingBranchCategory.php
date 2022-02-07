<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingBranchCategory
 *
 * @property int $id
 * @property int $branch_id
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|AccountingBranchCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchCategory whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AccountingBranchCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AccountingBranchCategory withoutTrashed()
 * @mixin \Eloquent
 */
class AccountingBranchCategory extends Model
{
    use SoftDeletes;
    protected $fillable = ["branch_id", "category_id"];
}
