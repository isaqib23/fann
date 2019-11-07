<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\PlacementRepository;
use App\Models\Placements;
use App\Validators\PlacementsValidator;

/**
 * Class PlacementsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PlacementRepositoryEloquent extends BaseRepository implements PlacementRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Placements::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
