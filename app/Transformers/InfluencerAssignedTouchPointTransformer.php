<?php

namespace App\Transformers;

use App\Models\CampaignAssignedJob;
use App\Models\CampaignAssignedJobDetail;
use League\Fractal\TransformerAbstract;

/**
 * Class InfluencerAssignedTouchPointTransformer.
 *
 * @package namespace App\Transformers;
 */
class InfluencerAssignedTouchPointTransformer extends TransformerAbstract
{
    protected $return = [];

    /**
     * Transform the CampaignAssignedJobDetail entity.
     *
     * @param CampaignAssignedJob $model
     *
     * @return array
     */
    public function transform(CampaignAssignedJob $model)
    {
        $this->return[] = [
            'id' => (int)$model->id,
            "placement_id" => (int)$model->placement_id,
            "user_id" => (int)$model->user_id,
            "campaign_id" => (int)$model->campaign_id,
            "campaign_invite_id" => (int)$model->campaign_invite_id,
            "rating" => (int)$model->rating,
            "eng_rate" => (int)$model->eng_rate,
            "work_rate" => (int)$model->work_rate,
            "tags" => (string)$model->tags,
            "post_count" => (int)$model->post_count,
            "comment_count" => (int)$model->comment_count,
            "like_count" => (int)$model->like_count,
            "follower_count" => (int)$model->follower_count,
            "following_count" => (int)$model->following_count,
            "assign_to" => $model->assignTo,
            "touch_points" => $model->campaign_assigned_job_details,
        ];

        return $this->return;
    }
}
