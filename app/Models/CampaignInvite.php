<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CampaignInvite.
 *
 * @package namespace App\Models;
 */
class CampaignInvite extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'campaign_id',
        'touch_point_id',
        'sender_id',
        'sent_from',
        'original_price',
        'influencer_price',
        'status'
    ];

}
