<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PusherNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $message;

    public $message_type;

    public $url;

    public $details;

    public function __construct($user, $message = null, $message_type = 'success', $url = null, $details = null)
    {
        $this->user         = $user;
        $this->message      = $message;
        $this->message_type = $message_type;
        $this->url          = $url;
        $this->details      = $details;
    }

    // public function broadcastWith()
    // {
    //     return [
    //         'message'      => $this->message,
    //         'message_type' => $this->message_type,
    //     ];
    // }

    public function broadcastOn()
    {
        return ["notification-send-{$this->user}"];
    }
}
