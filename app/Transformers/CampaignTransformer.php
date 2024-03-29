<?php

namespace App\Transformers;

use App\Models\CampaignTouchPointProduct;
use League\Fractal\TransformerAbstract;
use App\Models\Campaign;

/**
 * Class CampaignTransformer.
 *
 * @package namespace App\Transformers;
 */
class CampaignTransformer extends TransformerAbstract
{
    /**
     * Transform the Campaign entity.
     *
     * @param \App\Models\Campaign $model
     *
     * @return array
     */
    public function transform(Campaign $campaign)
    {
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
     * @param $campaign
     * @param array $return
     * @return array
     */
    private function touchPointPresentor($campaign, array $return): array
    {
        foreach ($campaign->touchPoint as $key => $touchPoint) {
            $guidelines = array_values(json_decode($touchPoint->additional->guidelines,true));
            array_unshift($guidelines, null);

            $return['touchPoints'][] = [
                'id'                => $touchPoint->id,
                'name'              => $touchPoint->name,
                'caption'           => $touchPoint->description,
                'placement_id'      => $touchPoint->placement_id,
                'hashtags'          => $touchPoint->additional->tags,
                'mentions'          => $touchPoint->additional->mentions,
                'guideLines'        => $guidelines,
                'amount'            => $touchPoint->amount,
                'productBrand'      => $touchPoint->company_id,
                'barter_as_dispatch'=> $touchPoint->barter_as_dispatch,
                'isBarter'          => $this->checkIsBarter($campaign, $touchPoint),
                'dispatchProduct'   => $this->touchPointProductPresentor($touchPoint->dispatch_product),
                'barterProduct'     => $this->touchPointProductPresentor($touchPoint->barter_product),
                'instaFormatFields' => $this->getInstaFormatFields($touchPoint->placementAction),
                'images'            => $this->getTouchPointMedia($touchPoint->media),
                "touchPointConditionalFields" => $this->getTouchPointConditionalFields($return)
            ];
        }
        return $return;
    }

    /**
     * @param $productId
     * @return mixed
     */
    public function touchPointProductPresentor($productId){

        $campaignTouchPointProduct = new CampaignTouchPointProduct();

        return $campaignTouchPointProduct
            ->select([
                'id',
                'name AS title',
                'outside_product_id AS productId',
                'outside_product_link',
                'outside_product_variant_id AS variantId',
                'outside_platform',
                'outside_product_image AS pImage'
            ])
            ->find($productId);
    }

    /**
     * @param $campaign
     * @param array $return
     * @return array
     */
    private function CampaignObjectivePresentor($campaign, array $return): array
    {
        $return['campaignObjective'] = [
            'objective_id'   => $campaign->objective->id,
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
    public function CampaignPaymentPresentor($campaign, array $return): array
    {
        $return['payment'] = [
            'additionalPayAsAmount'     => (!is_null($campaign['payment']) && $campaign['payment']->paymentType->slug == 'barter') ? (boolean)$campaign['payment']->is_primary : false,
            'additionalPayAsBarter'     => (!is_null($campaign['payment']) && $campaign['payment']->paymentType->slug == 'paid') ? (boolean)$campaign['payment']->is_primary : false,
            'paymentType'               => (!is_null($campaign['payment'])) ? $campaign['payment']->paymentType->slug : null,
            'platform'                  => (!is_null($campaign['payment'])) ? $campaign->primary_placement_id : null,
        ];
        return $return;
    }

    /**
     * @param array $return
     * @return array
     */
    private function getTouchPointConditionalFields(array $return): array
    {
        $return = [
            "touchPointTitle" => false,
            "touchPointInstagramFormat" => false,
            "touchPointPaymentFormat" => false,
            "isPaid" => false,
            "isBarter" => false,
            "additionalPayAsBarter" => false,
            "additionalPayAsAmount" => false,
            "touchPointProduct" => false,
            "touchPointBrand" => false
        ];
        return $return;
    }

    /**
     * @param $images
     * @return array
     */
    private function getTouchPointMedia($images)
    {
        $return = [];
        if($images) {
            foreach ($images as $key => $value){
                $return[] = [
                    'campaign_touch_point_id'   => $value->campaign_touch_point_id,
                    'imageURL'                  => '/'.$value->path.'/medium/'.$value->name,
                    'format'                    => $value->format,
                    'name'                      => $value->name,
                ];
            }
        }
        return $return;
    }

    /**
     * @param $data
     * @return array
     */
    private function getInstaFormatFields($data)
    {
        $bio_link = $data->firstWhere('link_type', 'instaBioLink');
        $story_link = $data->firstWhere('link_type', 'instaStoryLink');
        $return = [
            "id"            => null,
            "instaPost"     => (is_null($bio_link)) ? null : 'post',
            "instaBioLink"  => (is_null($bio_link)) ? false : $bio_link->link,
            "instaStory"    => (is_null($story_link)) ? null : 'story',
            "instaStoryLink"=> (is_null($story_link)) ? false : $story_link->link,
        ];

        return $return;
    }

    /**
     * @param $campaign
     * @param $touchPoint
     * @return bool
     */
    private function checkIsBarter($campaign, $touchPoint): bool
    {
        if ($touchPoint->dispatch_product === $touchPoint->barter_product) {
            return false;
        }

        if ($touchPoint->dispatch_product !== $touchPoint->barter_product) {
            return true;
        }

        if (is_null($touchPoint->company_id)) {
            return false;
        }

        return true;
    }
}
