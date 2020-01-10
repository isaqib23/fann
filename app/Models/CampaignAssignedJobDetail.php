<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CampaignAssignedJobDetail
 * @package App\Models
 */
class CampaignAssignedJobDetail extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'assigned_job_id',
        'assign_to_id',
        'campaign_invite_id',
        'assign_by_id',
        'campaign_touch_point_id',
        'campaign_invite_id',
        'status',
        'is_cloned'
    ];

    /**
     * @return HasOne
     */
    public function assignTo()
    {
        return $this->hasOne(User::class,'id', 'assign_to_id');
    }

    /**
     * @return HasOne
     */
    public function touchPoint()
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
