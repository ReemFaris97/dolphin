<?php

namespace App\Notifications;

use App\Traits\FireBase;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SupplierNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $message;
    public function __construct($message)
    {
        //
        $this->message = $message;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ["database", FireBaseChannel::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->message;
    }

    public function toFireBase($notifiable)
    {
        FireBase::notification(
            $notifiable,
            $this->message["title"],
            $this->message["body"],
            $this->message
        );
    }
}
