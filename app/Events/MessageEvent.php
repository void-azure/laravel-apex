<?php

namespace App\Events;

use App\User;
use App\Message;
use App\Room;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * The message event.
 */
class MessageEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;
    public $room;

    /**
     * Create a new event instance.
     *
     * @param \App\User    The user model.
     * @param \App\Message The message model.
     * @param \App\Room    The room model.
     *
     * @return void Returns nothing.
     */
    public function __construct(User $user, Message $message, Room $room)
    {
        $this->user = $user;
        $this->message = $message;
        $this->room = $room;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('room.' . $this->room->id);
    }
}
