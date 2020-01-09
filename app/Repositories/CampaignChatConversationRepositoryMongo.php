<?php

namespace App\Repositories;


use App\Models\CampaignChatConversation;
use Exception;
use Illuminate\Http\Request;
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
     * @var null
     */
    protected $collectionPrefix = 'campaign_job_';

    /**
     * @var
     */
     protected $campaignChatRepositoryMongo;

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
            $this->createChatCollection($request);
            return $this->model
                ->where('id', $request->id)
                ->where('placement_id', $request->placement_id)
                ->where('campaign_invite_id', $request->campaign_invite_id)
                ->update([
                    'participants' => [4]
                    ,
                    'id'                 => $request->id,
                    'placement_id'       => $request->placement_id,
                    'campaign_invite_id' => $request->campaign_invite_id,
                    'campaign_id'        => $request->campaign_id,
                    'campaign_job_id'    => $request->id
                ],
                [
                    'upsert' => true
                ]);

        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw new Exception($e->getMessage());

        }
    }

    /**
     * @param $request
     * @return mixed
     */
    public function createChatCollection($request)
    {
        $name = $this->assumeChatCollectionName($request);
        $this->campaignChatRepositoryMongo = app()->makeWith(CampaignChatRepositoryMongo::class, ['collectionName' => $name]);
        return $this->campaignChatRepositoryMongo->createWithBaseData($request);
    }

    /**
     * @param $request
     * @return string
     */
    public function assumeChatCollectionName($request)
    {
        $identity = $request->id;
        return $this->collectionPrefix . $identity;
    }

}
