<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Test;

class MyCustomEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $user = '';
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user)
    {
       $this->user = $user;
       
       Test::create([
           'name' => $user,
           'status' => 'login',
       ]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
