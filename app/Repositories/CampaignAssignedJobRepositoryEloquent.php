<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CampaignAssignedJobRepository;
use App\Models\CampaignAssignedJob;

/**
 * Class InfluencerCampaignStatisticsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignAssignedJobRepositoryEloquent extends BaseRepository implements CampaignAssignedJobRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CampaignAssignedJob::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
