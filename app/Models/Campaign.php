<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
        'eng_rate'
    ];

}
