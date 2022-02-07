<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingColumnCell
 *
 * @property int $id
 * @property string $name
 * @property int $column_id
 * @property string $width
 * @property string $height
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $empty
 * @property-read \App\Models\AccountingSystem\AccountingFaceColumn $column
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell whereColumnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell whereEmpty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingColumnCell whereWidth($value)
 * @mixin \Eloquent
 */
class AccountingColumnCell extends Model
{
    protected $fillable = ["column_id", "name", "empty"];

    public function column()
    {
        return $this->belongsTo(AccountingFaceColumn::class, "column_id");
    }
}
