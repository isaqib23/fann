<?php

namespace App\Repositories;

use App\Transformers\InfluencerAssignedTouchPointTransformer;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CampaignAssignedJobDetailRepository;
use App\Models\CampaignAssignedJobDetail;

/**
 * Class InfluencerJobRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignAssignedJobDetailRepositoryEloquent extends BaseRepository implements CampaignAssignedJobDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CampaignAssignedJobDetail::class;
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
     * @return mixed
     */
    public function getInfluencerCampaign($request)
    {
        return $this->with(["invite" => function($query) use ($request){
            $query->with(['campaign' => function($campaignQuery) use($request) {
                $campaignQuery->select(['id', 'name', 'slug','objective_id'])
                    ->with(['payment'  => function($query){
                        $query->with(['paymentType' => function($paymentQuery){
                            $paymentQuery->select(['id', 'name']);
                        }])->select(['payment_type_id', 'campaign_id']);
                    },
                    'objective' => function($objectiveQuery){
                        $objectiveQuery->select(['id', 'name', 'slug']);
                    },
                    'statistics' => function($statisticQuery) use ($request){
                        $statisticQuery->select(['user_id','campaign_id','placement_id','work_rate','rating', 'eng_rate', 'comment_count', 'like_count', 'follower_count'])
                            ->where('user_id',$request->input('user_id'));
                    }
                    ]);
            }]);
        }])
        ->findWhere([
            'assign_to_id' => $request->input('user_id'),
        ])->groupBy('campaign_invite_id');
    }
}
