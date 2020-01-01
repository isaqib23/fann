<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CampaignTouchPointProductShippment.
 *
 * @package namespace App\Models;
 */
class CampaignTouchPointProductShippment extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'outside_order_id',
        'dispatch_date',
        'discount_code',
        'fulfillment_status',
        'order_status_url',
        'outside_customer_id',
        'shipping_address',
        'order_json',
        'send_by',
        'touch_point_id',
        'touch_point_product_id'
    ];

}
