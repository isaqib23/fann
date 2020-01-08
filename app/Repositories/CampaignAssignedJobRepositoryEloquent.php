<?php

namespace App\Repositories;

use App\Transformers\InfluencerAssignedTouchPointTransformer;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CampaignAssignedJobRepository;
use App\Models\CampaignAssignedJob;

/**
 * Class InfluencerCampaignStatisticsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignAssignedJobRepositoryEloquent extends BaseRepository implements CampaignAssignedJobRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CampaignAssignedJob::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $request
     * @return array
     */
    public function getInfluencerAssignTouchPoint($request)
    {
        $results =  $this->with(['campaignAssignedJobDetails' => function($query){
            $query->with(['touchPoint']);
        },'assignTo'  => function($userQuery){
            $userQuery->with(['statistics' => function($statisticQuery){
                $statisticQuery->select(['placement_id', 'user_id', 'rating', 'eng_rate', 'comment_count', 'like_count', 'follower_count']);
            }])->select(['id', 'first_name', 'last_name', 'email']);
        }])
            ->findWhere([
                'user_id' => $request->input('user_id'),
                'campaign_invite_id' => $request->input('campaign_invite_id')
            ])->first();

        $response = (new InfluencerAssignedTouchPointTransformer())->transform($results);

        return $response;
    }
}
