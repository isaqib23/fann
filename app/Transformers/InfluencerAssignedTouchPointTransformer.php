<?php

namespace App\Transformers;

use App\Models\CampaignAssignedJobDetail;
use League\Fractal\TransformerAbstract;

/**
 * Class InfluencerAssignedTouchPointTransformer.
 *
 * @package namespace App\Transformers;
 */
class InfluencerAssignedTouchPointTransformer extends TransformerAbstract
{
    /**
     * Transform the CampaignAssignedJobDetail entity.
     *
     * @param CampaignAssignedJobDetail $model
     *
     * @return array
     */
    public function transform($model)
    {
        $return = [];

        foreach ($model as $key => $value) {
            if($key === 0) {
                $return[] = [
                    'id' => (int)$value->id,
                    "assign_to_id" => (int)$value->assign_to_id,
                    "assign_by_id" => (int)$value->assign_by_id,
                    "campaign_touch_point_id" => (int)$value->campaign_touch_point_id,
                    "campaign_invite_id" => (int)$value->campaign_invite_id,
                    "rating" => (int)$value->rating,
                    "eng_rate" => (int)$value->eng_rate,
                    "work_rate" => (int)$value->work_rate,
                    "tags" => (string)$value->tags,
                    "post_count" => (int)$value->post_count,
                    "comment_count" => (int)$value->comment_count,
                    "like_count" => (int)$value->like_count,
                    "follower_count" => (int)$value->follower_count,
                    "following_count" => (int)$value->following_count,
                    "assigned_job_id" => $value->assigned_job_id,
                    "is_cloned" => (boolean)$value->is_cloned,
                    "assign_to" => $value->assignTo,
                    "touch_point" => $value->touchPoint,
                ];
            }

            $return[0]['touchPoints'][] = $value->touchPoint;
        }

        return $return;
    }
}
