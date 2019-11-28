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
 * Class CampaignTouchPointRepositoryEloquent.
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
     * @var CampaignPaymentRepositoryEloquent
     */
    private $campaignPaymentRepositoryEloquent;

    /**
     * @var CampaignTouchPointMediaRepositoryEloquent
     */
    private $campaignTouchPointMediaRepositoryEloquent;

    /**
     * CampaignTouchPointRepositoryEloquent constructor.
     * @param Application $app
     * @param CampaignTouchPointProductRepository $campaignTouchPointProductRepository
     * @param CampaignTouchPointAdditionalRepositoryEloquent $campaignTouchPointAdditionalRepositoryEloquent
     * @param CampaignPaymentRepositoryEloquent $campaignPaymentRepositoryEloquent
     * @param CampaignTouchPointMediaRepositoryEloquent $campaignTouchPointMediaRepositoryEloquent
     */
    public function __construct(
        Application $app,
        CampaignTouchPointProductRepository $campaignTouchPointProductRepository,
        CampaignTouchPointAdditionalRepositoryEloquent $campaignTouchPointAdditionalRepositoryEloquent,
        CampaignPaymentRepositoryEloquent $campaignPaymentRepositoryEloquent,
        CampaignTouchPointMediaRepositoryEloquent $campaignTouchPointMediaRepositoryEloquent
    )
    {
        parent::__construct($app);
        $this->campaignTouchPointProductRepository = $campaignTouchPointProductRepository;
        $this->campaignTouchPointAdditionalRepositoryEloquent = $campaignTouchPointAdditionalRepositoryEloquent;
        $this->campaignPaymentRepositoryEloquent = $campaignPaymentRepositoryEloquent;
        $this->campaignTouchPointMediaRepositoryEloquent = $campaignTouchPointMediaRepositoryEloquent;
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

    public function saveInHierarchy($data)
    {
        $barterProduct = $dispatchProduct =  null;
        $touchPoint = $data['touchPoint'];

        //---- dispatch product
        if (!empty($touchPoint['dispatchProduct'])) {
            $dispatchProduct = $this->campaignTouchPointProductRepository->store($touchPoint['dispatchProduct']);
        }

        //---- shipment product
        if (!empty($touchPoint['barterProduct'])) {
            $barterProduct = $this->campaignTouchPointProductRepository->store($touchPoint['barterProduct']);
        }

        //---- multiple Payments
        if (!empty($data['payment'])) {
            $barterProduct = $this->campaignPaymentRepositoryEloquent->storeMultiple($data['payment'], $data['campaignId']);
        }

        //---- Touch Point
        $savedTouchPoint =  $this->create([
            'name'                => $touchPoint['caption'],
            'description'         => $touchPoint['name'],
            'dispatch_product'    => $dispatchProduct->id,
            'barter_product'      => $barterProduct == null ?  $dispatchProduct->id : $barterProduct->id,
            'campaign_id'         => $data['campaignId'],
            'placement_id'        => $data['payment']['platform'],
            'barter_as_dispatch'  => 1,
            'amount'              => $touchPoint['amount']
        ]);

        //---- additionals
        $this->campaignTouchPointAdditionalRepositoryEloquent->store($touchPoint, $savedTouchPoint);

        //---- multiple Images
        if (!empty($data['images'])) {
            $barterProduct = $this->campaignTouchPointMediaRepositoryEloquent->storeMultiple($data['images'], $savedTouchPoint);
        }

        //---- actions


    }

}
