<?php

namespace App\Repositories;

use App\Models\Placement;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\PlacementRepository;
use App\Validators\PlacementValidator;

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
        return Placement::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
