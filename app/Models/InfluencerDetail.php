<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class InfluencerDetail.
 *
 * @package namespace App\Models;
 */
class InfluencerDetail extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_meta_id',
        'user_id',
        'rating',
        'eng_rate',
        'work_rate',
        'tags',
        'post_count',
        'comment_count',
        'like_count',
        'follower_count',
        'following_count'
    ];

}
