<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingBranchFace
 *
 * @property int $id
 * @property string $name
 * @property int $branch_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AccountingSystem\AccountingBranch $branch
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingFaceColumn[] $columns
 * @property-read int|null $columns_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchFace newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchFace newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchFace query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchFace whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchFace whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchFace whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchFace whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingBranchFace whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingBranchFace extends Model
{
    protected $fillable = ["name", "branch_id"];

    public function branch()
    {
        return $this->belongsTo(AccountingBranch::class, "branch_id");
    }

    public function columns()
    {
        return $this->hasMany(AccountingFaceColumn::class, "face_id");
    }
}
