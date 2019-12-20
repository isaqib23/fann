<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CampaignTouchpoint.
 *
 * @package namespace App\Models;
 */
class CampaignTouchPoint extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'dispatch_product',
        'barter_product',
        'campaign_id',
        'placement_id',
        'barter_as_dispatch',
        'amount',
        'company_id'
    ];

    /**
     * @return HasOne
     */
    public function additional()
    {
        return $this->hasOne(CampaignTouchPointAdditional::class);
    }

    /**
     * @return HasMany
     */
    public function media()
    {
        return $this->hasMany(CampaignTouchPointMedia::class);
    }

    /**
     * @return HasMany
     */
    public function placementAction()
    {
        return $this->hasMany(CampaignTouchPointPlacementAction::class);
    }
}
