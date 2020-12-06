<?php

namespace App\Events;

use App\Models\StoreTransferRequest;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StoreTransferRequestAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $store_transaction;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(StoreTransferRequest $store_transaction)
    {
        //
        $this->store_transaction = $store_transaction;
    }
}
