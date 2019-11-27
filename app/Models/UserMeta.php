<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class UserMeta.
 *
 * @package namespace App\Models;
 */
class UserMeta extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * @var array
     */
    protected $casts = [
        'meta_json' => 'array'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'access_token',
        'provider',
        'provider_id',
        'provider_name',
        'provider_photo',
        'followers',
        'followings',
        'meta_json'
    ];


}
