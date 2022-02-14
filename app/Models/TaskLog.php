<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TaskLog
 *
 * @property int $id
 * @property int $old_user_id
 * @property int $new_user_id
 * @property int $task_id
 * @property string|null $notes
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $new_user
 * @property-read \App\Models\User $old_user
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereNewUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereOldUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TaskLog extends Model
{
    public $fillable = ["old_user_id", "new_user_id", "task_id", "notes"];

    public function old_user()
    {
        return $this->belongsTo("App\Models\User", "old_user_id");
    }
    public function new_user()
    {
        return $this->belongsTo("App\Models\User", "new_user_id");
    }
}
