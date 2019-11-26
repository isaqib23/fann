<?php

namespace App\Repositories;

use App\Contracts\CampaignTouchPointPlacementActionRepository;
use App\Models\CampaignTouchPointPlacementAction;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class CampaignTouchPointPlacementRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignTouchPointPlacementActionRepositoryEloquent extends BaseRepository implements CampaignTouchPointPlacementActionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CampaignTouchPointPlacementAction::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
