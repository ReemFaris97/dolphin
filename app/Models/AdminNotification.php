<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdminNotification
 *
 * @property int $id
 * @property int $creator_id
 * @property string|null $title
 * @property string|null $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Notification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminNotification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdminNotification extends Model
{
    protected $table = "admin_notifications";
    protected $fillable = ["title", "body", "creator_id"];

    public function notifications()
    {
        return $this->hasMany(
            "App\Models\Notification",
            "admin_notification_id"
        );
    }
}
