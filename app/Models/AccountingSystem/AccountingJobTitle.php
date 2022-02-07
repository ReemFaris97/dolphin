<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingJobTitle
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingJobTitle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingJobTitle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingJobTitle query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingJobTitle whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingJobTitle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingJobTitle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingJobTitle whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingJobTitle whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingJobTitle extends Model
{
    protected $fillable = ["name", "active"];
    protected $table = "accounting_job_titles";
}
