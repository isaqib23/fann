<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CampaignAssignedJob
 * @package App\Model
 */
class CampaignAssignedJob extends Model implements Transformable
{
    use TransformableTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'platform_id',
        'campaign_invite_id',
        'user_id',
        'campaign_id',
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
