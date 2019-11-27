<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
        'amount'
    ];

}
