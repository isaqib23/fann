<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CampaignTouchPointAdditionalRepository;
use App\Models\CampaignTouchPointAdditional;
use App\Validators\CampaignTouchPointAdditionalValidator;

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
    
}
