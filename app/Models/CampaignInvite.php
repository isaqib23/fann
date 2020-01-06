<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    /**
     * @return HasOne
     */
    public function influencerJob()
    {
        return $this->hasOne(InfluencerJob::class,'campaign_invite_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
