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
        'placement_id',
        'sender_id',
        'sent_from',
        'original_price',
        'quoted_price',
        'status'
    ];

    public function influencer_job()
    {
        return $this->hasOne(InfluencerJob::class,'campaign_invite_id', 'id');
    }
}
