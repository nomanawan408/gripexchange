<?php

namespace App\Events;
 
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WithdrawalRequested
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $withdrawal;
    /**
    * Create a new event instance.
    */


   public function __construct($withdrawal)
   {
       $this->withdrawal = $withdrawal;
   }

    /**
     * Create a new event instance.
     */
   
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
        return 'withdrawal-requested';
    }

    public function broadcastWith()
    {
        return [
            'deposit' => $this->withdrawal
        ];
    }
}
