<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NotificationCategory
 *
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NotificationCategory extends Model
{
    protected $fillable = ["name"];
}
