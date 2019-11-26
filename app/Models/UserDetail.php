<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class UserDetail.
 *
 * @package namespace App\Models;
 */
class UserDetail extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'bio',
        'address',
        'picture',
        'niche_id',
        'timezone',
        'state_id',
        'country_id',
        'website',
        'phone'
    ];

}