<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CampaignAssignedJobsRepository;
use App\Models\CampaignAssignedJobs;

/**
 * Class InfluencerCampaignStatisticsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignAssignedJobsRepositoryEloquent extends BaseRepository implements CampaignAssignedJobsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CampaignAssignedJobs::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
