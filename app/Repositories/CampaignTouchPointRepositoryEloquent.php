<?php

namespace App\Repositories;

use App\Contracts\CampaignTouchPointProductRepository;
use Illuminate\Container\Container as Application;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\campaignTouchpointRepository;
use App\Models\CampaignTouchPoint;
use App\Validators\CampaignTouchpointValidator;

/**
 * Class CampaignTouchpointRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignTouchPointRepositoryEloquent extends BaseRepository implements CampaignTouchPointRepository
{
    /**
     * @var CampaignTouchPointProductRepository
     */
    private $campaignTouchPointProductRepository;
    /**
     * @var CampaignTouchPointAdditionalRepositoryEloquent
     */
    private $campaignTouchPointAdditionalRepositoryEloquent;

    /**
     * CampaignTouchPointRepositoryEloquent constructor.
     * @param Application $app
     * @param CampaignTouchPointProductRepository $campaignTouchPointProductRepository
     * @param CampaignTouchPointAdditionalRepositoryEloquent $campaignTouchPointAdditionalRepositoryEloquent
     */
    public function __construct(
        Application $app,
        CampaignTouchPointProductRepository $campaignTouchPointProductRepository,
        CampaignTouchPointAdditionalRepositoryEloquent $campaignTouchPointAdditionalRepositoryEloquent
    )
    {
        parent::__construct($app);
        $this->campaignTouchPointProductRepository = $campaignTouchPointProductRepository;
        $this->campaignTouchPointAdditionalRepositoryEloquent = $campaignTouchPointAdditionalRepositoryEloquent;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CampaignTouchPoint::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function saveCampaignInHierarchy($data)
    {
        $barterProduct = $dispatchProduct =  null;
        $touchPoint = $data['touchPoint'];

        if (!empty($touchPoint['dispatchProduct'])) {
            $dispatchProduct = $this->campaignTouchPointProductRepository->store($touchPoint['dispatchProduct']);
        }

        if (!empty($touchPoint['barterProduct'])) {
            $barterProduct = $this->campaignTouchPointProductRepository->store($touchPoint['barterProduct']);
        }

        $savedTouchPoint =  $this->updateOrCreate([],[
            'name'              => $touchPoint['caption'],
            'description'       => $touchPoint['name'],
            'dispatch_product'  => $dispatchProduct->id,
            'barter_product'    => $barterProduct == null ?  $dispatchProduct->id : $barterProduct->id,
            'campaign_id'       => $data['id'],
            'placement_id'      => $data['payment']['platform'],
            'amount'            => $touchPoint['amount']
        ]);

        $this->campaignTouchPointAdditionalRepositoryEloquent->store($data, (array) $savedTouchPoint);
    }

}
