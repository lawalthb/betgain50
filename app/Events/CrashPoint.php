<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class CrashPoint implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $point;
  public $label;
  public $chartData;
  public $current_game_id;


  /**
   * Create a new event instance.
   */
  public function __construct($point,  $current_game_id)
  {
    $this->point = $point;

    $this->current_game_id = $current_game_id;
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return array<int, \Illuminate\Broadcasting\Channel>
   */
  public function broadcastOn()
  {


    return
      new Channel('game');
  }

  public function broadcastAs()
  {
    return 'CrashPoint';
  }
}
