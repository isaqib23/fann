<?php

namespace App\Repositories;

use App\Models\CampaignTouchPointProduct;
use Exception;
use Illuminate\Support\Str;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CampaignRepository;
use App\Models\Campaign;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class CampaignRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignRepositoryEloquent extends BaseRepository implements CampaignRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Campaign::class;
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
     * @throws ValidatorException
     */
    public function store($request)
    {
        return $this->updateOrCreate(
            [
                'id'    => $request['id'],
            ],
            [
            'name' => $request['name'],
            'slug' => $this->createSlug($request['name']),
            'objective_id'  => $request['objective_id']
        ]);
    }

    /**
     * @param $title
     * @param int $id
     * @return string
     * @throws Exception
     */
    public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = Str::slug($title);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)) {
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= ($allSlugs->count() + 1); $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new Exception('Can not create a unique slug');
    }

    /**
     * @param $slug
     * @param int $id
     * @return mixed
     */
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Campaign::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }

    public function presentor($campaign){
        $return['campaignInformation'] = [
            'id'            => (int) $campaign->id,
            'name'          => (string) $campaign->name,
            'slug'          => (string) $campaign->slug,
            'description'   => (string) $campaign->description,
            'objective_id'  => (int) $campaign->objective_id,
        ];

        // campaign objective Presentor
            $return = $this->CampaignObjectivePresentor($campaign, $return);
        // campaign payment Presentor
            $return = $this->CampaignPaymentPresentor($campaign, $return);
        // Touch Points Presentor
        if($campaign->touchPoint) {
            $return = $this->touchPointPresentor($campaign, $return);
        }
        return $return;
    }

    /**
     * @param $touchPoint
     * @return mixed
     *
     */
    public function touchPointProductPresentor($touchPoint){

        $campaignTouchPointProduct = new CampaignTouchPointProduct();

        $productId = ($touchPoint->dispatch_product != $touchPoint->barter_product) ? $touchPoint->barter_product : $touchPoint->dispatch_product;

        return $campaignTouchPointProduct
            ->select([
                'id',
                'name AS title',
                'outside_product_id',
                'outside_product_link',
                'outside_product_variant_id',
                'outside_platform',
                'outside_product_image AS image'
            ])
            ->find($productId);
    }

    /**
     * @param $request
     * @return array
     *
     */
    public function getCampaignTouchPointWithPresenter($request){
        $campaign = $this->with([
            'payment'  => function($query){
                $query->with(['paymentType']);
            },
            'touchPoint' => function($query){
                $query->with(['additional']);
            },
            'objective'
        ])
            ->findWhere(['slug' => $request->input('slug')])
            ->first();

        $campaign = $this->presentor($campaign);

        return $campaign;
    }

    /**
     * @param $campaign
     * @param array $return
     * @return array
     */
    private function touchPointPresentor($campaign, array $return): array
    {
        foreach ($campaign->touchPoint as $key => $touchPoint) {
            $return['touchPoints'][] = [
                'id'                => $touchPoint->id,
                'name'              => $touchPoint->name,
                'caption'           => $touchPoint->description,
                'placement_id'      => $touchPoint->placement_id,
                'hashtags'          => $touchPoint->additional->tags,
                'mentions'          => $touchPoint->additional->mentions,
                'guideLines'        => json_decode($touchPoint->additional->guidelines, true),
                'amount'            => $touchPoint->amount,
                'dispatchProduct'   => $this->touchPointProductPresentor($touchPoint),
                'barterProduct'     => ($touchPoint->dispatch_product != $touchPoint->barter_product) ? $this->touchPointProductPresentor($touchPoint) : null,
                'instaPost'         => null,
                'instaBioLink'      => null,
                'instaStory'        => null,
                'instaStoryLink'    => null,
                'images'            => [],
            ];
        }
        return $return;
    }

    /**
     * @param $campaign
     * @param array $return
     * @return array
     */
    private function CampaignObjectivePresentor($campaign, array $return): array
    {
        $return['campaignObjective'] = [
            'Objective_id'   => $campaign->objective->id,
            'name'          => $campaign->objective->slug,
            'slug'          => $campaign->objective->slug
        ];
        return $return;
    }

    /**
     * @param $campaign
     * @param array $return
     * @return array
     */
    private function CampaignPaymentPresentor($campaign, array $return): array
    {
        $return['payment'] = [
            'additionalPayAsAmount'     => (!is_null($campaign['payment']) && $campaign['payment']->paymentType->slug == 'barter') ? (boolean)$campaign['payment']->is_primary : false,
            'additionalPayAsBarter'     => (!is_null($campaign['payment']) && $campaign['payment']->paymentType->slug == 'paid') ? (boolean)$campaign['payment']->is_primary : false,
            'paymentType'               => (!is_null($campaign['payment'])) ? $campaign['payment']->paymentType->slug : null,
            'platform'                  => (!is_null($campaign['payment'])) ? $campaign['payment']->payment_type_id : null,
        ];
        return $return;
    }

    /**
     * @param $request
     * @return array
     *
     */
    public function getCampaignObjectivetWithPresenter($request){
        $objective = $this->with([
            'payment'  => function($query){
                $query->with(['paymentType']);
            }])
            ->findWhere([
                'slug'  => $request->input('slug')
            ])->first();

        $campaign = $this->CampaignPaymentPresentor($objective,$objective->toArray());

        return $campaign;
    }

}
