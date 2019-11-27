<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CampaignTouchPointAdditional.
 *
 * @package namespace App\Models;
 */
class CampaignTouchPointAdditional extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'campaign_touch_point_id',
        'tags',
        'mentions',
        'guidelines'
    ];

}
