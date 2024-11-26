<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InternalTransfers
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $internalTransfers;
    /**
     * Create a new event instance.
     */
    public function __construct($internalTransfers)
    {
        //
        $this->internalTransfers = $internalTransfers;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return ['admin-notifications'];
    }
    public function broadcastAs(): string
    {
        return 'internal-transfer';
    }

    public function broadcastWith()
    {
        return [
            'internalTransfer' => $this->internalTransfers
        ];
    }
}
