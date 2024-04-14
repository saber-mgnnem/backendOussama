<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;

    public function broadcastWith()
    {
        return [
            'message' => $this->message
        ];
    }

    public function broadcastAs()
    {
        return 'my-event';
    }

    public function broadcastOn()
    {
        return ['my-channel'];
    }

    public function __construct($message)
    {
        $this->message = $message;
    }
}
