<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

/**
 * Class CampaignChatConversation
 *
 * @package App\Models
 */
class CampaignChatConversation extends Eloquent
{
    /**
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * @var array
     */
    protected $dates = ['created_at'];

    /**
     * @var string
     */
    protected $collection = 'campaign_chat_conversations';

    /**
     * @param $collection
     * @return bool
     */
    public function collectionExists($collection)
    {
        $db = $this->getConnection();

        foreach ($db->listCollections() as $collectionFromMongo) {
            if ($collectionFromMongo->getName() == $collection) {
                return true;
            }
        }

        return false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'participants',
        'campaign_id',
        'placement_id'
    ];

}
