<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CampaignTouchPointAdditionalRepository;
use App\Models\CampaignTouchPointAdditional;
use App\Validators\CampaignTouchPointAdditionalValidator;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class CampaignTouchPointAdditionalRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignTouchPointAdditionalRepositoryEloquent extends BaseRepository implements CampaignTouchPointAdditionalRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CampaignTouchPointAdditional::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $data
     * @param $touchPoint
     * @return mixed
     * @throws ValidatorException
     */
    public function store($data, $touchPoint)
    {
        $touchPoint = is_object($touchPoint) ? $touchPoint->toArray() : $touchPoint;

        if (array_key_exists(0 , $data['guideLines']) && is_null($data['guideLines'][0])) {
            unset($data['guideLines'][0]);
        }

        return $this->updateOrCreate(
            [
                'campaign_touch_point_id'  => $touchPoint['id'],
            ],
            [
            'campaign_touch_point_id' => $touchPoint['id'],
            'tags'                    => $data['hashtags'],
            'mentions'                => $data['mentions'],
            'guidelines'              => json_encode($data['guideLines'], JSON_FORCE_OBJECT )
        ]);
    }

}
