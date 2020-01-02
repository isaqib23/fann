<?php

namespace App\Repositories;

use App\Models\CampaignChat;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Log;
use MongoDB\BSON\ObjectId;


/**
 * Class CampaignChatRepositoryMongo
 *
 * @package App\Repositories
 */
class CampaignChatRepositoryMongo
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
     * @var string|null
     */
    protected $currentCollectionName;

    /**
     * CampaignChatRepositoryMongo constructor.
     * @param $collectionName
     * @throws BindingResolutionException
     */
    public function __construct($collectionName)
    {
        $this->model = app()->make(CampaignChat::class);
        $this->collection = CampaignChat::setCollection($collectionName);
        $this->currentCollectionName = $collectionName;

      //  dd($this->model->collectionExists('campaign_2_2'));
    }


  /*  public function init($collectionName)
    {
        $this->model = CampaignChat::setCollection($collectionName);
        return $this;
    }*/
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

            if ($this->model->collectionExists($this->currentCollectionName)) {
                return $this->collection
                    ->where('campaign_id', '2')
                    ->where('placement_id', '2')
                    ->push('content' , [
                    [
                        'sender' => 18,
                        'content' => 'new record to push',
                        'time_created' => Carbon::now(),
                        'type' => 'text',
                        "_id"  => new ObjectId()
                    ]
                ]);
            }

            return $this->collection->create($data);

        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw new Exception($e->getMessage());

        }
    }

}
