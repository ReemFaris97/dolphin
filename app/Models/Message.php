<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Message
 *
 * @property int $id
 * @property int $user_id
 * @property int $receiver_id
 * @property string|null $image
 * @property string|null $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $channel_id
 * @property-read mixed $channel
 * @property-read User $receiver
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereReceiverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUserId($value)
 * @mixin \Eloquent
 */
class Message extends Model
{
    protected $guarded = [];
    protected $fillable = [
        "user_id",
        "receiver_id",
        "image",
        "message",
        "channel_id",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function receiver()
    {
        return $this->belongsTo(User::class, "receiver_id");
    }

    function type()
    {
        if (!is_null($this->message)) {
            return "text";
        }
        if (substr($this->image, -3) == "3gp") {
            return "voice";
        }
        return "image";
    }

    public function getChannelAttribute()
    {
        $arr = array_sort($this->only("user_id", "receiver_id"));
        return "privatechat." . implode("_", $arr);
    }
}
