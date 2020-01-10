<?php

namespace App\Repositories;

use App\Contracts\CampaignAssignedJobDetailRepository;
use App\Contracts\CampaignAssignedJobRepository;
use App\Contracts\CampaignTouchPointRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CampaignInviteRepository;
use App\Models\CampaignInvite;
use App\Validators\CampaignInviteValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Container\Container as Application;

/**
 * Class CampaignInviteRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignInviteRepositoryEloquent extends BaseRepository implements CampaignInviteRepository
{
    /**
     * @var CampaignAssignedJobDetailRepository
     */
    private $campaignAssignedJobDetailRepository;
    /**
     * @var CampaignAssignedJobRepository
     */
    private $campaignAssignedJobRepository;
    /**
     * @var CampaignTouchPointRepository
     */
    private $campaignTouchPointRepository;

    /**
     * CampaignInviteRepositoryEloquent constructor.
     * @param Application $app
     * @param CampaignAssignedJobDetailRepository $campaignAssignedJobDetailRepository
     * @param CampaignAssignedJobRepository $campaignAssignedJobRepository
     * @param CampaignTouchPointRepository $campaignTouchPointRepository
     */
    public function __construct(
        Application $app,
        CampaignAssignedJobDetailRepository $campaignAssignedJobDetailRepository,
        CampaignAssignedJobRepository $campaignAssignedJobRepository,
        CampaignTouchPointRepository $campaignTouchPointRepository
    )
    {
        parent::__construct($app);
        $this->app = $app;
        $this->campaignAssignedJobDetailRepository = $campaignAssignedJobDetailRepository;
        $this->campaignAssignedJobRepository = $campaignAssignedJobRepository;
        $this->campaignTouchPointRepository = $campaignTouchPointRepository;
    }
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
        return $this->updateOrCreate(
            [
                'user_id'        => $request->user_id,
                'campaign_id'    => $request->campaign_id,
            ],
            [
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

    /**
     * @param $request
     * @return mixed
     */
    public function getCampaignInvitesByInfluencer($request)
    {
        return $this->with(['campaign' => function($campaignQuery) use($request) {
            $campaignQuery->select(['id', 'name', 'slug','objective_id','created_by_company_id','description'])
                ->with(['payment'  => function($query){
                    $query->with(['paymentType' => function($paymentQuery){
                        $paymentQuery->select(['id', 'name']);
                    }])->select(['payment_type_id', 'campaign_id']);
                },
                'company' => function($objectiveQuery){
                    $objectiveQuery->select(['id', 'name', 'logo']);
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
                'status'  => $request->input('status'),
            ]);
    }

    /**
     * @param $request
     * @return mixed
     * @throws ValidatorException
     */
    public function rejectCampaignInvite($request)
    {
        return $this->update([
                'status'    => 'reject'
            ],
            $request->input('invite_id'));
    }

    /**
     * @param $request
     * @return bool
     * @throws ValidatorException
     */
    public function acceptCampaignInvite($request)
    {
        // Insert Record for Campaign Assigned Jobs
        $assigned_jobs = $this->campaignAssignedJobRepository->store($request);

        // Getting Campaign Touch Point
        $touchPoints = $this->campaignTouchPointRepository->findWhere([
            'campaign_id'   => $request->input('campaign_id')
        ]);

        foreach ($touchPoints as $key => $value){
            $request->merge([
                'touch_point_id'    => $value->id,
                'assigned_job_id'   => $assigned_jobs->id
            ]);
            // Insert Record for Campaign Assigned Job Details
            $this->campaignAssignedJobDetailRepository->store($request);
        }

        // Change Status of Campaign Invite
        return $this->update([
            'status'    => 'accept'
        ],
            $request->input('invite_id'));
    }

}
