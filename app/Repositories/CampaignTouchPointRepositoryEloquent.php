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
     * @var CampaignTouchPointPlacementActionRepositoryEloquent
     */
    private $campaignTouchPointPlacementActionRepositoryEloquent;

    /**
     * CampaignTouchPointRepositoryEloquent constructor.
     * @param Application $app
     * @param CampaignTouchPointProductRepository $campaignTouchPointProductRepository
     * @param CampaignTouchPointAdditionalRepositoryEloquent $campaignTouchPointAdditionalRepositoryEloquent
     * @param CampaignPaymentRepositoryEloquent $campaignPaymentRepositoryEloquent
     * @param CampaignTouchPointMediaRepositoryEloquent $campaignTouchPointMediaRepositoryEloquent
     * @param CampaignTouchPointPlacementActionRepositoryEloquent $campaignTouchPointPlacementActionRepositoryEloquent
     */
    public function __construct(
        Application $app,
        CampaignTouchPointProductRepository $campaignTouchPointProductRepository,
        CampaignTouchPointAdditionalRepositoryEloquent $campaignTouchPointAdditionalRepositoryEloquent,
        CampaignPaymentRepositoryEloquent $campaignPaymentRepositoryEloquent,
        CampaignTouchPointMediaRepositoryEloquent $campaignTouchPointMediaRepositoryEloquent,
        CampaignTouchPointPlacementActionRepositoryEloquent $campaignTouchPointPlacementActionRepositoryEloquent
    )
    {
        parent::__construct($app);
        $this->campaignTouchPointProductRepository = $campaignTouchPointProductRepository;
        $this->campaignTouchPointAdditionalRepositoryEloquent = $campaignTouchPointAdditionalRepositoryEloquent;
        $this->campaignPaymentRepositoryEloquent = $campaignPaymentRepositoryEloquent;
        $this->campaignTouchPointMediaRepositoryEloquent = $campaignTouchPointMediaRepositoryEloquent;
        $this->campaignTouchPointPlacementActionRepositoryEloquent = $campaignTouchPointPlacementActionRepositoryEloquent;
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
        //dd($data);
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
            $savedPayments = $this->campaignPaymentRepositoryEloquent->storeMultiple($data['payment'], $data['campaignId']);
        }

        // Prepare Barter Product
        if($dispatchProduct !== null){
            $barterProduct = $barterProduct == null ?  $dispatchProduct->id : $barterProduct->id;
        }
        //---- Touch Point
        $savedTouchPoint =  $this->updateOrCreate(
            [
                'id'              => $touchPoint['id'],
            ],
            [
                'name'                => $touchPoint['name'],
                'description'         => $touchPoint['caption'],
                'dispatch_product'    => $dispatchProduct === null ? null : $dispatchProduct->id,
                'barter_product'      => $barterProduct,
                'campaign_id'         => $data['campaignId'],
                'company_id'          => isset($touchPoint['productBrand']) ? $touchPoint['productBrand'] : null,
                'placement_id'        => $data['payment']['platform'],
                'barter_as_dispatch'  => (!empty($touchPoint['dispatchProduct']) && !empty($touchPoint['barterProduct'])) ? 0 : 1,
                'amount'              => $touchPoint['amount']
            ]);

        //---- additionals
        $this->campaignTouchPointAdditionalRepositoryEloquent->store($touchPoint, $savedTouchPoint);

        //---- multiple Images
        if (!empty($touchPoint['images'])) {
            $savedImages = $this->campaignTouchPointMediaRepositoryEloquent->storeMultiple($touchPoint['images'], $savedTouchPoint);
        }

        /**
         * Actions
         * In case of Insta story or post
         */
        if ($touchPoint['touchPointConditionalFields']['touchPointInstagramFormat']) {
            $this->campaignTouchPointPlacementActionRepositoryEloquent->prepareDataAndStore(
                $touchPoint['instaFormatFields'],
                $savedTouchPoint
            );
        }

        return $savedTouchPoint;

    }

}
