<?php

namespace App\Repositories;


use App\Models\CampaignChatConversation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Log;
use MongoDB\BSON\ObjectId;


/**
 * Class CampaignChatConversationRepositoryMongo
 * @package App\Repositories
 */
class CampaignChatConversationRepositoryMongo
{
    /**
     * @var string|null
     */
    protected $collection = null;

    /**
     * @var null
     */
    protected $model;


    /**
     * CampaignChatConversationRepositoryMongo constructor.
     *
     * @param CampaignChatConversation $campaignChatConversation
     */
    public function __construct(CampaignChatConversation $campaignChatConversation)
    {
        $this->model = $campaignChatConversation;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        try {
                return $this->model
                    ->where('campaign_id', '4')
                    ->where('placement_id', '2')
                    ->update([
                        'participants' => [4]
                        ,
                        'campaign_id'  =>  '4',
                        'placement_id' => '2'
                    ],
                    ['upsert' => true]);

        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw new Exception($e->getMessage());

        }
    }

}
