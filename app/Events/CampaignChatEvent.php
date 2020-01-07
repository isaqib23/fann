<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CampaignChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var
     */
    private $chatTo;

    /**
     * @var
     */
    private $chatBy;

    /**
     * @var null
     */
    private $content;

    /**
     * CampaignChatEvent constructor.
     *
     * @param $chatTo
     * @param $chatBy
     * @param null $content
     */
    public function __construct($chatTo, $chatBy, $content = null)
    {
        $this->chatTo = $chatTo;
        $this->chatBy = $chatBy;
        $this->content = $content;

        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('campaignChat');
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'chatTo' => $this->chatTo,
            'chatBy' => $this->chatBy,
            'content' => $this->content
        ];
    }
}
