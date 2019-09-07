<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    protected $table = 'admin_notifications';
    protected $fillable = ['title', 'body', 'creator_id'];

    public function notifications()
    {

        return $this->hasMany('App\Models\Notification', 'admin_notification_id');
    }
}
