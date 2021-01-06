<?php

namespace App\Listeners;

use App\Events\MessageCreated;
use App\Traits\FirebasOperation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyMessageReceiver
{
    use FirebasOperation;


    /**
     * Handle the event.
     *
     * @param  MessageCreated  $event
     * @return void
     */
    public function handle(MessageCreated $event)
    {
        $title = 'هناك رساله جديدة ';
        $message = $event->message->message;
        $type = 'new_message';
        $data = [
            'item_id' => $event->message->user_id,
            'message' => $message,
            'type' => $type,
            'title' => $title

        ];
        $users = $event->message->receiver()->get();
        $this->fire($title, $message, $data, $users);
    }
}
