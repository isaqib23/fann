<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\InfluencerCampaignStatisticsRepository;
use App\Models\InfluencerCampaignStatistics;
use App\Validators\InfluencerCampaignStatisticsValidator;

/**
 * Class InfluencerCampaignStatisticsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InfluencerCampaignStatisticsRepositoryEloquent extends BaseRepository implements InfluencerCampaignStatisticsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InfluencerCampaignStatistics::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
