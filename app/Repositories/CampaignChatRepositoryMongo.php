<?php

namespace App\Repositories;

use App\Models\CampaignChat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Log;


/**
 * Class CampaignChatRepositoryMongo
 *
 * @package App\Repositories
 */
class CampaignChatRepositoryMongo
{
    /**
     * @var null
     */
    protected $model = null;

    /**
     * CampaignChatRepositoryMongo constructor.
     * @param $collectionName
     */
    public function __construct($collectionName)
    {
        $this->model = CampaignChat::setCollection($collectionName);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        try {

            $data = [
                'participants' => [
                    '7' => [
                        'uid'           => 7,
                        'first_name'    => 'business owner',
                        'last_name'     => 'test',
                    ],
                    '8' => [
                        'uid'           => 8,
                        'first_name'    => 'influencer',
                        'last_name'     => 'test',
                    ],
                ],
                'content' => [
                    [
                        'sender' => 8,
                        'content' => 'how are you',
                        'time_created' => Carbon::now(),
                        'type' => 'text'
                    ],
                    [
                        'sender' => 7,
                        'content' => 'i am good',
                        'time_created' => Carbon::now(),
                        'type' => 'text'
                    ]
                ],
                'campaign_id' => '2',
                'placement_id' => '2'
            ];
dd($this->model);
            return $this->model->create($data);

        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw new Exception($e->getMessage());

        }
    }

}
