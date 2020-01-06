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

    /**
     * @param $request
     * @return mixed
     */
    public function getInfluencerAssignTouchPoint($request)
    {
        return $this->with(['assignTo'  => function($userQuery){
            $userQuery->with(['statistics' => function($statisticQuery){
                $statisticQuery->select(['platform_id', 'user_id', 'rating', 'eng_rate', 'comment_count', 'like_count', 'follower_count']);
            }])->select(['id', 'first_name', 'last_name', 'email']);
        }
        ,'touchPoint'
        ])
            ->findWhere([
                'assign_to_id' => $request->input('user_id'),
                'campaign_id' => $request->input('campaign_id')
            ])->groupBy('campaign_invite_id');
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getInfluencerCampaign($request)
    {
        return $this->with(['campaign' => function($query) use($request) {
            $query->select(['id', 'name', 'slug','objective_id'])
                ->with(['payment'  => function($query){
                $query->with(['paymentType' => function($paymentQuery){
                    $paymentQuery->select(['id', 'name']);
                }])->select(['payment_type_id', 'campaign_id']);
            },
                'objective' => function($objectiveQuery){
                    $objectiveQuery->select(['id', 'name', 'slug']);
                },
                 'statistics' => function($statisticQuery) use ($request){
                    $statisticQuery->select(['user_id','campaign_id','platform_id','work_rate','rating', 'eng_rate', 'comment_count', 'like_count', 'follower_count'])
                        ->where('user_id',$request->input('user_id'));
                }
                ]);
        }])
        ->findWhere([
            'assign_to_id' => $request->input('user_id'),
        ])->groupBy('campaign_id');
    }
}
