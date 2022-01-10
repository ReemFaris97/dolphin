<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $touches = ['messages'];

    public function chatUsers()
    {
        return $this->hasMany(ChatUser::class);
    }

    public function getNameAttribute()
    {
        $names = [];
        foreach ($this->chatUsers as $chatUser) {
            $names[] = $chatUser->user->name;
        }

        return implode('|', $names);
    }


    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
