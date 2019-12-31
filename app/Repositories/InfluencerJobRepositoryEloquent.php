<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\InfluencerJobRepository;
use App\Models\InfluencerJob;
use App\Validators\InfluencerJobValidator;

/**
 * Class InfluencerJobRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InfluencerJobRepositoryEloquent extends BaseRepository implements InfluencerJobRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InfluencerJob::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getInfluencerAssignTouchPoint($request)
    {
        return $this->with(['assign_to'  => function($userQuery){
            $userQuery->with(['statistics' => function($statisticQuery){
                $statisticQuery->select(['platform_id', 'user_id', 'rating', 'eng_rate', 'comment_count', 'like_count', 'follower_count']);
            }])->select(['id', 'first_name', 'last_name', 'email']);
        }
        ,'touch_point'
        ])
            ->findWhere([
                'assign_to_id' => $request->input('user_id'),
                'campaign_id' => $request->input('campaign_id')
            ])->groupBy('campaign_invite_id');
    }
}
