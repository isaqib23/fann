<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class InitiateCampaignChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var null
     */
    private $content;

    /**
     * @var
     */
    private $campaignAssignedJob;

    /**
     * @var
     */
    private $campaignId;

    /**
     * @var
     */
    private $placementId;

    /**
     * @var
     */
    private $participants;

    /**
     * InitiateCampaignChatEvent constructor.
     *
     * @param $campaignAssignedJob
     * @param $campaignId
     * @param $placementId
     * @param $participants
     */
    public function __construct($campaignAssignedJob, $campaignId, $placementId, $participants)
    {
        $this->campaignAssignedJob = $campaignAssignedJob;
        $this->campaignId = $campaignId;
        $this->placementId = $placementId;
        $this->participants = $participants;

        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('InitiateCampaignChat');
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'campaignAssignedJob' => $this->campaignAssignedJob,
            'campaignId'          => $this->campaignId,
            'placementId'         => $this->placementId,
            'participants'        => $this->participants
        ];
    }
}
