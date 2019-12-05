<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\InfluencerStatisticsRepository;
use App\Models\InfluencerStatistics;
use App\Validators\InfluencerStatisticsValidator;

/**
 * Class InfluencerStatisticsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InfluencerStatisticsRepositoryEloquent extends BaseRepository implements InfluencerStatisticsRepository
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
