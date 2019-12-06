<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class InfluencerDetail.
 *
 * @package namespace App\Models;
 */
class UserPlatformMeta extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_platform_id',
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

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     *
     */
    public function userPlatform()
    {
        return $this->belongsTo(UserPlatformMeta::class);
    }

}
