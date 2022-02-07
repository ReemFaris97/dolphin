<?php

namespace App\Models\AccountingSystem;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingUserPermission
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $model_type
 * @property int $model_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $model
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserPermission query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserPermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserPermission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserPermission whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserPermission whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserPermission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountingUserPermission whereUserId($value)
 * @mixin \Eloquent
 */
class AccountingUserPermission extends Model
{
    protected $fillable = ["model_id", "model_type", "user_id"];
    protected $table = "accounting_users_premissions";

    public function model()
    {
        return $this->morphTo();
    }
}
