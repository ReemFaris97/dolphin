<?php

namespace App\Models\AccountingSystem;

use App\Traits\HashPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AccountingSystem\AccountingTemplate
 *
 * @property int $id
 * @property int|null $first_account_id
 * @property int|null $second_account_id
 * @property string|null $result
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $operation
 * @property int|null $template_id
 * @property string $report_no
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $first_account
 * @property-read \App\Models\AccountingSystem\AccountingAccount|null $second_account
 * @property-read AccountingTemplate|null $template
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate whereFirstAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate whereOperation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate whereReportNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate whereSecondAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingTemplate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountingTemplate extends Model
{
    protected $fillable = [
        "first_account_id",
        "second_account_id",
        "result",
        "operation",
        "template_id",
        "report_no",
    ];
    protected $table = "accounting_templates";

    public function first_account()
    {
        return $this->belongsTo(AccountingAccount::class, "first_account_id");
    }
    public function second_account()
    {
        return $this->belongsTo(AccountingAccount::class, "second_account_id");
    }
    public function template()
    {
        return $this->belongsTo(AccountingTemplate::class, "template_id");
    }
}
