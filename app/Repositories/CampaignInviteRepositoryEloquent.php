<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CampaignInviteRepository;
use App\Models\CampaignInvite;
use App\Validators\CampaignInviteValidator;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class CampaignInviteRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignInviteRepositoryEloquent extends BaseRepository implements CampaignInviteRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CampaignInvite::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws ValidatorException
     */
    public function store(Request $request)
    {
        return $this->create([
            'user_id'        => $request->user_id,
            'campaign_id'    => $request->campaign_id,
            'placement_id'   => $request->placement_id,
            'sender_id'      => $request->sender_id,
            'sent_from'      => $request->sent_from,
            'original_price' => $request->price,
            'quoted_price'   => 0,
            'status'         => $request->status,
        ]);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getInfluencerCampaign($request)
    {
        return $this->with(['campaign' => function($campaignQuery) use($request) {
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
        }])
            ->findWhere([
                'user_id' => $request->input('user_id'),
            ]);
    }

}
