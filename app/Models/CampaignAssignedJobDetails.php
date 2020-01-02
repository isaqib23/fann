<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class InfluencerJob.
 *
 * @package namespace App\Models;
 */
class CampaignAssignedJobDetails extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * @var string
     */
    protected $table = 'campaign_assigned_job_details';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'assign_to_id',
        'campaign_invite_id',
        'assign_by_id',
        'campaign_id',
        'placement_id',
        'campaign_touch_point_id',
        'campaign_invite_id',
        'status'
    ];

    /**
     * @return HasOne
     */
    public function assign_to()
    {
        return $this->hasOne(User::class,'id', 'assign_to_id');
    }

    /**
     * @return HasOne
     */
    public function touch_point()
    {
        return $this->hasOne(CampaignTouchPoint::class,'id', 'campaign_touch_point_id');
    }

    /**
     * @return HasOne
     */
    public function invite()
    {
        return $this->hasOne(CampaignInvite::class,'id', 'campaign_invite_id');
    }
}
