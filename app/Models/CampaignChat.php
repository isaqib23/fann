<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

/**
 * Class CampaignChat
 *
 * @package App\Models
 */
class CampaignChat extends Eloquent
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
     * @param $collection
     * @return CampaignChat
     */
    public static function setCollection($collection)
    {
        $set = new self();
        $set->collection = $collection;
        return $set;
    }

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
        'content',
        'campaign_id',
        'placement_id'
    ];

}
