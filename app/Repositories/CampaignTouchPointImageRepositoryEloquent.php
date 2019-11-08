<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\campaignTouchpointImageRepository;
use App\Models\CampaignTouchPointImage;
use App\Validators\CampaignTouchpointImageValidator;

/**
 * Class CampaignTouchpointImageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignTouchPointImageRepositoryEloquent extends BaseRepository implements CampaignTouchPointImageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CampaignTouchpointImage::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
