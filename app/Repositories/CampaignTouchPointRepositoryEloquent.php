<?php

namespace App\Repositories;

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

}
