<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\InfluencerEntireStatisticsRepository;
use App\Models\InfluencerEntireStatistics;
use App\Validators\InfluencerEntireStatisticsValidator;

/**
 * Class InfluencerStatisticsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InfluencerEntireStatisticsRepositoryEloquent extends BaseRepository implements InfluencerEntireStatisticsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InfluencerStatistics::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
