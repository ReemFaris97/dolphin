<?php

namespace App\Events;

use App\Models\Charge;
use App\Models\NotificationCategory;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChargeReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $charge;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Charge $charge)
    {
        $this->user = $user;
        $this->charge = $charge;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
