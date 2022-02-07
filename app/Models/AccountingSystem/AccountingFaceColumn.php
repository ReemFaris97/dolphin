<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingFaceColumn
 *
 * @property int $id
 * @property string $name
 * @property int $face_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccountingSystem\AccountingColumnCell[] $cells
 * @property-read int|null $cells_count
 * @property-read \App\Models\AccountingSystem\AccountingBranchFace $face
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFaceColumn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFaceColumn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFaceColumn query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFaceColumn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFaceColumn whereFaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFaceColumn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFaceColumn whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingFaceColumn whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingFaceColumn extends Model
{
    protected $fillable = ["face_id", "name"];

    public function face()
    {
        return $this->belongsTo(AccountingBranchFace::class, "face_id");
    }
    public function cells()
    {
        return $this->hasMany(AccountingColumnCell::class, "column_id");
    }
}
