<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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


    /**
     * @return HasMany
     */
    public function campaign_assigned_job_details()
    {
        return $this->hasMany(CampaignAssignedJobDetail::class,'assigned_job_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function assignTo()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }
}
