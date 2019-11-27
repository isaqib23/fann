<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CampaignTouchPointProduct.
 *
 * @package namespace App\Models;
 */
class CampaignTouchPointProduct extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'outside_product_id',
        'outside_product_link',
        'outside_product_variant_id',
        'outside_platform',
        'outside_product_image',
    ];

}
