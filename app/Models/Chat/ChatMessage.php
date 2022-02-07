<?php

namespace App\Models\Chat;

use App\Events\NewMessageEvent;
use App\Http\Resources\Suppliers\MessageResource;
use App\Traits\HasImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        "chat_id",
        "user_type",
        "user_id",
        "message",
        "type",
        "attachment",
        "thumbnail",
    ];

    public static function booted()
    {
        static::created(function (ChatMessage $message) {
            broadcast(
                new NewMessageEvent(
                    new MessageResource($message),
                    $message->chat_id
                )
            )->toOthers();
        });
    }

    public function user()
    {
        return $this->morphTo("user");
    }

    public function getAttachmentAttribute($value)
    {
        if ($value) {
            return asset($value);
        } else {
            return null;
        }
    }

    public function setAttachmentAttribute($value)
    {
        if (is_file($value)) {
            $this->attributes["attachment"] = Fileuploader($value);
        } else {
            $this->attributes["attachment"] = $value;
        }
    }
    public function getThumbnailAttribute($value)
    {
        if ($value) {
            return asset($value);
        } else {
            return null;
        }
    }

    public function setThumbnailAttribute($value)
    {
        if (is_file($value)) {
            $this->attributes["thumbnail"] = Fileuploader($value);
        } else {
            $this->attributes["thumbnail"] = $value;
        }
    }
}
