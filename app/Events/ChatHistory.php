<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatHistory implements ShouldBroadcast

{
  use Dispatchable, InteractsWithSockets, SerializesModels;


  public $chatHistory;

  /**
   * Create a new event instance.
   */
  public function __construct($chatHistory)
  {
    $this->chatHistory = $chatHistory;
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return array<int, \Illuminate\Broadcasting\Channel>
   */
  public function broadcastOn()
  {
    return new Channel('game');
  }

  public function broadcastAs()
  {
    return 'chatHistory';
  }
}
