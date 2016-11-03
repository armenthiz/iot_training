<?php

namespace App\Events;

use Sentinel;
use Reminder;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ReminderEvent
{
    use InteractsWithSockets, SerializesModels;

    public $user;
    public $reminder;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $reminder)
    {
        $this->user = $user;
        $this->reminder = $reminder;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
