<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LogoutEvent implements ShouldBroadcast
{
  public $userId;

  public function __construct($userId)
  {
    $this->userId = $userId;
  }

  public function broadcastOn()
  {
    return new Channel('public-channel');
  }

  public function broadcastAs()
  {
    return 'user.loggedout';
  }
}
