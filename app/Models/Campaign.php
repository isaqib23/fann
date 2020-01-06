<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Campaign.
 *
 * @package namespace App\Models;
 */
class Campaign extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'touch_points',
        'total_amount',
        'objective_id',
        'impressions',
        'actions',
        'eng_rate',
        'primary_placement_id',
        'user_id',
        'created_by_company_id'
    ];

    /**
     * @return HasOne
     *
     */
    public function payment()
    {
        return $this->hasOne(CampaignPayment::class);
    }

    /**
     * @return HasMany
     *
     */
    public function touchPoint()
    {
        return $this->hasMany(CampaignTouchPoint::class);
    }

    /**
     * @return HasOne
     *
     */
    public function objective()
    {
        return $this->hasOne(CampaignObjective::class, 'id', 'objective_id');
    }

    /**
     * @return HasOne
     *
     */
    public function placement()
    {
        return $this->hasOne(Placement::class, 'id', 'primary_placement_id');
    }

    /**
     * @return HasMany
     */
    public function proposal()
    {
        return $this->hasMany(CampaignInvite::class);
    }

    /**
     * @return HasMany
     */
    public function statistics()
    {
        return $this->hasMany(InfluencerCampaignStatistics::class);
    }
}
